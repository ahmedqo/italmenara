<?php

namespace App\Http\Controllers;

use App\Functions\Core;
use App\Functions\Mail as Mailer;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Crypt;
use App\Models\Quotation;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Request as Requested;
use App\Models\Setting;
use App\Models\Visitor;

class CoreController extends Controller
{
    public function index_view()
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $requests = Requested::whereBetween('created_at', [$startDate, $endDate])->get()->count();
        $invoices = Invoice::whereBetween('created_at', [$startDate, $endDate])->get()->count();
        $quotations = Quotation::whereBetween('created_at', [$startDate, $endDate])->get()->count();

        $total = [
            Core::reduceSum(Requested::whereBetween('created_at', [$startDate, $endDate])->get()),
            Core::reduceSum(Quotation::whereBetween('created_at', [$startDate, $endDate])->get()),
            Core::reduceSum(Invoice::whereBetween('created_at', [$startDate, $endDate])->get()),
        ];

        return view('core.index', compact('total', 'requests', 'invoices', 'quotations'));
    }

    public function setting_view()
    {
        return view('core.settings');
    }

    public function setting_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'contact_email' => ['required', 'email'],
            'print_phone' => ['required', 'string'],
            'print_email' => ['required', 'email'],
            'currency' => ['required', 'string'],
            'period' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        foreach ([
            'auto_quotation',
            'contact_email',
            'auto_invoice',
            'print_email',
            'print_phone',
            'currency',
            'period',
            'instagram',
            'telegram',
            'facebook',
            'youtube',
            'tiktok',
            'x',
        ] as $type) {
            Setting::findBy($type)->update([
                'content' => $Request->input($type)
            ]);
        }

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }


    public function sellers_action()
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $data = Item::with('Product')
            ->where('target_type', 'App\Models\Invoice')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->groupBy('product')
            ->map(function ($group) {
                $Product = $group->first()->Product;

                $total = $group->reduce(function ($carry, $item) {
                    return $carry + $item->quantity;
                }, 0);

                $id = $Product->id;
                $storage = $Product->Images[0]->storage;
                $price = $Product->price;
                $name = $Product->name;
                $sku = $Product->sku;

                return compact('id', 'storage', 'sku', 'name', 'price', 'total');
            })
            ->sortByDesc('total')
            ->take(10)->toArray();

        return response()->json(['data' => array_values($data)]);
    }

    public function visitors_action()
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $data = Visitor::with('Product')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->groupBy('product')
            ->map(function ($group) {
                $Product = $group->first()->Product;

                $views = $group->reduce(function ($carry, $item) {
                    return $carry + $item->count;
                }, 0);

                $id = $Product->id;
                $storage = $Product->Images[0]->storage;
                $price = $Product->price;
                $name = $Product->name;
                $sku = $Product->sku;

                return compact('id', 'storage', 'sku', 'name', 'price', 'views');
            })
            ->sortByDesc('views')
            ->take(10)->toArray();

        return response()->json(['data' => array_values($data)]);
    }

    public function charts_action()
    {
        [$startDate, $endDate, $columns] = Core::getDates();

        $requestsColumns = array_map(function ($item) {
            return $item;
        }, $columns);
        $quotationsColumns = array_map(function ($item) {
            return $item;
        }, $columns);
        $invoiceColumns = array_map(function ($item) {
            return $item;
        }, $columns);

        Requested::whereBetween('created_at', [$startDate, $endDate])->get()
            ->groupBy(function ($request) {
                return Core::groupKey($request);
            })
            ->map(function ($group) {
                return Core::groupSum($group);
            })
            ->each(function ($item, $key) use (&$requestsColumns) {
                $requestsColumns[$key] = $item;
            });
        Quotation::whereBetween('created_at', [$startDate, $endDate])->get()
            ->groupBy(function ($quote) {
                return Core::groupKey($quote);
            })
            ->map(function ($group) {
                return Core::groupSum($group);
            })
            ->each(function ($item, $key) use (&$quotationsColumns) {
                $quotationsColumns[$key] = $item;
            });
        Invoice::whereBetween('created_at', [$startDate, $endDate])->get()
            ->groupBy(function ($invoice) {
                return Core::groupKey($invoice);
            })
            ->map(function ($group) {
                return Core::groupSum($group);
            })
            ->each(function ($item, $key) use (&$invoiceColumns) {
                $invoiceColumns[$key] = $item;
            });

        $data = [
            array_keys($columns),
            array_values($requestsColumns),
            array_values($quotationsColumns),
            array_values($invoiceColumns)
        ];

        return response()->json(['data' => array_values($data)]);
    }

    public function mail_action($type, $id)
    {
        $Class = $type == 'invoice' ? Invoice::class : Quotation::class;
        $Instance = $Class::findorfail($id);


        Mailer::plain([
            'subject' => __(ucfirst($type) . ' Document'),
            'content' => __('You can preview and print your ' . $type . ' by clicking on the link below'),
            'from' => new Address(Core::getSetting('contact_email'), env('APP_NAME')),
            'to' => new Address($Instance->email, $Instance->name),
            'link' => [
                'url' => route('views.guest.' . strtolower($type), Crypt::encryptString($Instance->id)),
                'txt' => __('Preview ' . ucfirst($type))
            ]
        ]);

        return Redirect::back()->with([
            'message' => __('Sent successfully'),
            'type' => 'success'
        ]);
    }
}

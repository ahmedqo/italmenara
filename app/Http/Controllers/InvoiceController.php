<?php

namespace App\Http\Controllers;

use App\Functions\Core;
use App\Functions\Mail as Mailer;
use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Crypt;
use App\Models\Quotation;
use App\Models\Request as Requested;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class InvoiceController extends Controller
{
    public function index_view(Request $Request)
    {
        $data = Invoice::with('Items')->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search($Request->search);
        }
        $data = $data->cursorPaginate(50);
        return view('invoice.index', compact('data'));
    }

    public function store_view(Request $Request)
    {
        $data = null;
        if ($Request->input('quotation')) {
            $data = Quotation::with('Items')->findorfail($Request->input('quotation'));
        }
        if ($Request->input('request')) {
            $data = Requested::with('Items')->findorfail($Request->input('request'));
        }
        return view('invoice.store', compact('data'));
    }

    public function patch_view($id)
    {
        $data = Invoice::with('Items')->findorfail($id);
        return view('invoice.patch', compact('data'));
    }

    public function scene_view($id)
    {
        $data = Invoice::with('Items')->findorfail($id);
        return view('invoice.scene', compact('data'));
    }

    public function search_action(Request $Request)
    {
        $data = Invoice::with('Items')->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function store_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string'],
            'type' => ['required', 'string'],
            'charges' => ['required', 'numeric'],
            'items' => ['required', 'array'],
            'items.*' => ['required', 'json'],
        ]);


        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Invoice::$ITEMS = [];
        foreach ($Request->items as $json) {
            $item = json_decode($json, true);
            array_push(Invoice::$ITEMS, [
                'product' => $item['product'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        $Invoice = Invoice::create($Request->merge([
            'total' =>  0
        ])->all());

        if (Core::getSetting('auto_invoice')) {
            Mailer::plain([
                'subject' => __('Request Invoice'),
                'content' => __('You can preview and print your invoice by clicking on the link below'),
                'from' => new Address(Core::getSetting('contact_email'), env('APP_NAME')),
                'to' => new Address($Invoice->email, $Invoice->name),
                'link' => [
                    'url' => route('views.guest.invoice', Crypt::encryptString($Invoice->id)),
                    'txt' => __('Preview Invoice')
                ]
            ]);
        }

        return Redirect::route('views.invoices.store')->with([
            'message' => __('Created successfully'),
            'type' => 'success'
        ]);
    }

    public function patch_action(Request $Request, $id)
    {
        $validator = Validator::make($Request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string'],
            'type' => ['required', 'string'],
            'charges' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Invoice = Invoice::findorfail($id);

        if ($Request->deleted && !$Request->items && $Invoice->Items->count() == count($Request->deleted)) {
            return Redirect::back()->withInput()->with([
                'message' => __('The product field is required'),
                'type' => 'error'
            ]);
        }

        $Invoice->update($Request->all());

        if ($Request->items) {
            foreach ($Request->items as $json) {
                $item = json_decode($json, true);
                $data = [
                    'product' => $item['product'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ];
                if (isset($item['id'])) Item::findorfail($item['id'])->update($data);
                else  $Invoice->Items()->create($data);
            }
        }

        if ($Request->deleted) {
            foreach ($Request->deleted as $id) {
                Item::findorfail($id)->delete();
            }
        }

        $Invoice->update(['total' => $Invoice->Items()->sum('total')]);

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }

    public function clear_action($id)
    {
        Invoice::findorfail($id)->delete();

        return Redirect::route('views.invoices.index')->with([
            'message' => __('Deleted successfully'),
            'type' => 'success'
        ]);
    }
}

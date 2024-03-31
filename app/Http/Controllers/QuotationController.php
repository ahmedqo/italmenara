<?php

namespace App\Http\Controllers;

use App\Functions\Core;
use App\Functions\Mail as Mailer;
use App\Models\Quotation;
use App\Models\Item;
use Illuminate\Mail\Mailables\Address;
use App\Models\Request as Requested;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class QuotationController extends Controller
{
    public function index_view(Request $Request)
    {
        $data = Quotation::with('Items')->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search($Request->search);
        }
        $data = $data->cursorPaginate(50);
        return view('quotation.index', compact('data'));
    }

    public function store_view(Request $Request)
    {
        $data = null;
        if ($Request->input('request')) {
            $data = Requested::with('Items')->findorfail($Request->input('request'));
        }
        return view('quotation.store', compact('data'));
    }

    public function patch_view($id)
    {
        $data = Quotation::with('Items')->findorfail($id);
        return view('quotation.patch', compact('data'));
    }

    public function scene_view($id)
    {
        $data = Quotation::with('Items')->findorfail($id);
        return view('quotation.scene', compact('data'));
    }

    public function search_action(Request $Request)
    {
        $data = Quotation::with('Items')->orderBy('id', 'DESC');
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

        Quotation::$ITEMS = [];
        foreach ($Request->items as $json) {
            $item = json_decode($json, true);
            array_push(Quotation::$ITEMS, [
                'product' => $item['product'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        $Quotation = Quotation::create($Request->merge([
            'total' =>  0
        ])->all());

        $Quotation = Quotation::with('Items')->findorfail($Quotation->id);

        if (Core::getSetting('auto_quotation')) {
            Mailer::plain([
                'subject' => __('Request Quotation'),
                'content' => __('You can preview and print your quotation by clicking on the link below'),
                'from' => new Address(Core::getSetting('contact_email'), env('APP_NAME')),
                'to' => new Address($Quotation->email, $Quotation->name),
                'link' => [
                    'url' => route('views.guest.quotation', Crypt::encryptString($Quotation->id)),
                    'txt' => __('Preview Quotation')
                ]
            ]);
        }

        return Redirect::route('views.quotations.store')->with([
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
            'charges' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Quotation = Quotation::findorfail($id);

        if ($Request->deleted && !$Request->items && $Quotation->Items->count() == count($Request->deleted)) {
            return Redirect::back()->withInput()->with([
                'message' => __('The product field is required'),
                'type' => 'error'
            ]);
        }

        $Quotation->update($Request->all());

        if ($Request->items) {
            foreach ($Request->items as $json) {
                $item = json_decode($json, true);
                $data = [
                    'product' => $item['product'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ];
                if (isset($item['id'])) Item::findorfail($item['id'])->update($data);
                else  $Quotation->Items()->create($data);
            }
        }

        if ($Request->deleted) {
            foreach ($Request->deleted as $id) {
                Item::findorfail($id)->delete();
            }
        }

        $Quotation->update(['total' => $Quotation->Items()->sum('total')]);

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }

    public function clear_action($id)
    {
        Quotation::findorfail($id)->delete();

        return Redirect::route('views.quotations.index')->with([
            'message' => __('Deleted successfully'),
            'type' => 'success'
        ]);
    }
}

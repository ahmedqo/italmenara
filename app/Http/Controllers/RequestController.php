<?php

namespace App\Http\Controllers;

use App\Functions\Core;
use App\Functions\Mail as Mailer;
use Illuminate\Http\Request;
use App\Models\Request as Requested;
use App\Models\Product;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class RequestController extends Controller
{
    public function index_view(Request $Request)
    {
        $data = Requested::with('Items')->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search($Request->search);
        }
        $data = $data->cursorPaginate(50);
        return view('request.index', compact('data'));
    }

    public function scene_view($id)
    {
        $data = Requested::with('Items')->findorfail($id);
        return view('request.scene', compact('data'));
    }

    public function search_action(Request $Request)
    {
        $data = Requested::with('Items')->orderBy('id', 'DESC');
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
            'items' => ['required', 'array'],
            'items.*' => ['required', 'json'],
        ]);


        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Requested::$ITEMS = [];
        foreach ($Request->items as $json) {
            $item = json_decode($json, true);
            $Product = Product::findOrFail($item['product']);
            array_push(Requested::$ITEMS, [
                'product' =>  $Product->id,
                'quantity' => $item['quantity'],
                'price' =>  $Product->price,
            ]);
        }

        Requested::create($Request->merge([
            'total' =>  0
        ])->all());

        Mailer::plain([
            'subject' => __('Quotation Request'),
            'from' => new Address(env('MAIL_NOREPLAY_ADDRESS'), env('APP_NAME')),
            'to' => new Address($Request->email, $Request->name),
            'content' => __('We received your request and we will email you the quotation as soon as possible.'),
        ]);

        Mailer::plain([
            'subject' => __('New Quotation Request'),
            'from' => new Address(env('MAIL_NOREPLAY_ADDRESS'), env('APP_NAME')),
            'to' => new Address(Core::getSetting('contact_email'), env('APP_NAME')),
            'content' => __('New quotation request available.'),
        ]);

        return Redirect::route('views.guest.request')->with([
            'message' => __('Sent successfully'),
            'type' => 'success',
            'clear' => true,
        ]);
    }

    public function clear_action($id)
    {
        Requested::findorfail($id)->delete();

        return Redirect::route('views.requests.index')->with([
            'message' => __('Deleted successfully'),
            'type' => 'success'
        ]);
    }
}

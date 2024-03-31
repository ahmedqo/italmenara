<?php

namespace App\Http\Controllers;

use App\Functions\Core;
use App\Functions\Mail as Mailer;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Mail\Mailables\Address;
use App\Models\Brand;
use App\Models\Invoice;
use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;


class GuestController extends Controller
{
    public function home()
    {
        $principal = Section::with('Images')->where('type', 'principal')->first();
        $business = Section::with('Images')->where('type', 'business')->first();
        $shipping = Section::with('Images')->where('type', 'shipping')->first();

        $categories = Category::with('Image')->latest()->get()->take(5);
        $products = Product::with('Images')->where('status', 'available')->latest()->get()->take(8);

        return view('guest.home', compact('principal', 'business', 'shipping', 'categories', 'products'));
    }

    public function category()
    {
        $data = Category::with('Image')->orderBy('id', 'DESC')->cursorPaginate(20);
        return view('guest.category', compact('data'));
    }

    public function brand()
    {
        $data = Brand::with('Image')->orderBy('id', 'DESC')->cursorPaginate(20);
        return view('guest.brand', compact('data'));
    }

    public function product(Request $Request)
    {
        $items = [
            [__('Home'), route('views.guest.home')]
        ];
        $seo = null;

        $data = Product::with('Images')->where('status', 'available');
        if ($Request->search) {
            $data = $data->search($Request->search);
            array_push($items, [__("Search")]);
            array_push($items, [$Request->search]);
        }

        if ($Request->category) {
            $Category = Category::where('slug', $Request->category)->first();
            if ($Category) {
                $data = $data->where('category', $Category->id);
                $seo = $Category->description;
                array_push($items, [__("Categories"), route('views.guest.category')]);
                array_push($items, [ucwords($Category->name), route('views.guest.product', [
                    'category' => $Category->slug
                ])]);
            }
        }

        if ($Request->brand) {
            $Brand = Brand::where('slug', $Request->brand)->first();
            if ($Brand) {
                $data = $data->where('brand', $Brand->id);
                $seo = $Brand->description;
                array_push($items, [__("Brands"), route('views.guest.brand')]);
                array_push($items, [ucwords($Brand->name), route('views.guest.product', [
                    'brand' => $Brand->slug
                ])]);
            }
        }

        array_push($items, [__("Products"), route('views.guest.product')]);

        $data = $data->cursorPaginate(20);

        $categories = Category::latest()->get()->take(10);

        return view('guest.product', compact('data', 'items', 'categories', 'seo'));
    }

    public function show($slug)
    {
        $data = Product::with('Brand')->with('Category')->with('Images')->where('slug', $slug)->first();
        Core::visitor($data->id);
        return view('guest.show', compact('data'));
    }

    public function search(Request $Request)
    {
        $product = Product::with('Images')->findOrFail($Request->product);
        $data = [
            'url' => route('views.guest.show', $product->slug),
            'src' => $product->Images[0]->storage,
            'name' => $product->name,
        ];
        return response()->json(['data' => $data]);
    }

    public function request()
    {
        return view('guest.request');
    }

    public function contact(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string'],
            'message' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Mailer::plain([
            'from' => new Address($Request->email, $Request->name),
            'to' => new Address(Core::getSetting('contact_email'), env('APP_NAME')),
            'subject' => ucwords(__('New Contact Email')),
            'content' => __('Phone') . ': ' . $Request->phone . PHP_EOL . $Request->message,
        ]);

        return Redirect::route('views.guest.home')->with([
            'message' => __('Sent successfully'),
            'type' => 'success'
        ]);
    }

    public function quotation($id)
    {
        $data = Quotation::with('Items')->findorfail(Crypt::decryptString($id));
        return view('pdf.quotation', compact('data'));
    }

    public function invoice($id)
    {
        $data = Invoice::with('Items')->findorfail(Crypt::decryptString($id));
        return view('pdf.invoice', compact('data'));
    }

    public function faq()
    {
        return view('guest.faq');
    }

    public function term()
    {
        $list = [
            [
                'ttl' => __('Acceptance of Terms'),
                'txt' => [
                    __('By accessing or using our website, you acknowledge that you have read, understood, and agree to be bound by these Terms and Conditions.'),
                    __('These terms may be updated from time to time, and it is your responsibility to check for updates. Your continued use of the website after any changes constitutes acceptance of those changes.')
                ]
            ],
            [
                'ttl' => __('Use of the Website'),
                'txt' => [
                    __('You agree to use this website for lawful purposes and in a manner that does not infringe on the rights of any third party or restrict or inhibit their use and enjoyment of the website.'),
                    __('You shall not use the website in any way that could damage, disable, overburden, or impair any aspect of our website.')
                ]
            ],
            [
                'ttl' => __('Product Information'),
                'txt' => [
                    __('While we strive to provide accurate product information on our website, we do not warrant the accuracy, completeness, or reliability of any product information.'),
                    __('Prices, product descriptions, and availability are subject to change without notice.')
                ]
            ],
            [
                'ttl' => __('Orders and Payments'),
                'txt' => [
                    __('Placing an order on our website constitutes an offer to purchase the products.'),
                    __('We reserve the right to refuse or cancel any order for any reason at any time.'),
                    __('All payments are due upon completion of the order.')
                ]
            ],
            ['ttl' => __('Limitation of Liability'), 'txt' => __('To the extent permitted by law, ITALMENARA shall not be liable for any direct, indirect, incidental, consequential, or punitive damages arising out of your use of, or inability to use, the website or the materials on the website.')],
            ['ttl' => __('Governing Law'), 'txt' => __('These Terms and Conditions shall be governed by and construed in accordance with the laws of Morocco.')],
        ];
        return view('guest.term', compact('list'));
    }

    public function return()
    {
        $list = [
            [
                'ttl' => __('Eligibility'),
                'txt' => [
                    __('We accept returns within 30 days of the purchase date.'),
                    __('To be eligible for a return, the item must be unused, in its original packaging, and in the same condition as received.')
                ]
            ],
            [
                'ttl' => __('Return Authorization'),
                'txt' =>
                __('Our customer service team will provide you with a Return Authorization (RA) number and instructions on how to return the item.'),
            ],
            [
                'ttl' => __('Packaging'),
                'txt' =>
                __('Please ensure the item is securely packaged to prevent damage during transit.')
            ],
            [
                'ttl' => __('Return Address'),
                'txt' => [
                    __('Ship the item to the address provided along with the RA number.'),
                    __('The cost of return shipping is the responsibility of the customer unless the return is due to an error on our part.'),
                ]
            ],
            ['ttl' => __('Refund Processing'), 'txt' => __('Once we receive the returned item, we will inspect it and process the refund within 10 business days.')],
            ['ttl' => __('Payment Method'), 'txt' => __('Refunds will be issued to the original payment method used for the purchase.')],
            ['ttl' => __('Shipping Costs'), 'txt' => __('Original shipping costs are non-refundable unless the return is due to an error on our part.')],
        ];
        return view('guest.return', compact('list'));
    }
}

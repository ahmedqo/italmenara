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
        if (!$data) abort(404);
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
        $list = [];
        return view('guest.faq', compact('list'));
    }

    public function term()
    {
        $list = [
            [
                'ttl' => __('Acceptance of Terms'),
                'txt' => [
                    __('By accessing or using our <a style="all: revert;" href=":hom">website</a>, you acknowledge that you have read, understood, and agree to be bound by these Terms and Conditions.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('These terms may be updated from time to time, and it is your responsibility to check for updates. Your continued use of the <a style="all: revert;" href=":hom">website</a> after any changes constitutes acceptance of those changes.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ])
                ]
            ],
            [
                'ttl' => __('Use of the Website'),
                'txt' => [
                    __('You agree to use this <a style="all: revert;" href=":hom">website</a> for lawful purposes and in a manner that does not infringe on the rights of any third party or restrict or inhibit their use and enjoyment of the <a style="all: revert;" href=":hom">website</a>.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('You shall not use the <a style="all: revert;" href=":hom">website</a> in any way that could damage, disable, overburden, or impair any aspect of our <a style="all: revert;" href=":hom">website</a>.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ])
                ]
            ],
            [
                'ttl' => __('Product Information'),
                'txt' => [
                    __('While we strive to provide accurate <a style="all: revert;" href=":pro">products</a> information on our <a style="all: revert;" href=":hom">website</a>, we do not warrant the accuracy, completeness, or reliability of any <a style="all: revert;" href=":pro">products</a> information.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('Prices, <a style="all: revert;" href=":pro">products</a> descriptions, and availability are subject to change without notice.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ])
                ]
            ],
            [
                'ttl' => __('Orders and Payments'),
                'txt' => [
                    __('Placing an order on our <a style="all: revert;" href=":hom">website</a> constitutes an offer to purchase the <a style="all: revert;" href=":pro">products</a>.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('We reserve the right to refuse or cancel any order for any reason at any time.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('All payments are due upon completion of the order.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ])
                ]
            ],
            [
                'ttl' => __('Limitation of Liability'),
                'txt' => __('To the extent permitted by law, <a style="all: revert;" href=":hom">ITALMENARA</a> shall not be liable for any direct, indirect, incidental, consequential, or punitive damages arising out of your use of, or inability to use, the <a style="all: revert;" href=":hom">website</a> or the materials on the <a style="all: revert;" href=":hom">website</a>.', [
                    'hom' => route('views.guest.home'),
                    'pro' => route('views.guest.product'),
                ])
            ],
            [
                'ttl' => __('Governing Law'),
                'txt' => __('These Terms and Conditions shall be governed by and construed in accordance with the laws of Morocco.', [
                    'hom' => route('views.guest.home'),
                    'pro' => route('views.guest.product'),
                ])
            ],
        ];
        return view('guest.term', compact('list'));
    }

    public function return()
    {
        $list = [
            [
                'ttl' => __('Eligibility'),
                'txt' => [
                    __('We accept returns within 30 days of the purchase date.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('To be eligible for a return, the item must be unused, in its original packaging, and in the same condition as received.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ])
                ]
            ],
            [
                'ttl' => __('Return Authorization'),
                'txt' =>
                __('Our customer service team will provide you with a Return Authorization (RA) number and instructions on how to return the item.', [
                    'hom' => route('views.guest.home'),
                    'pro' => route('views.guest.product'),
                ]),
            ],
            [
                'ttl' => __('Packaging'),
                'txt' =>
                __('Please ensure the item is securely packaged to prevent damage during transit.', [
                    'hom' => route('views.guest.home'),
                    'pro' => route('views.guest.product'),
                ])
            ],
            [
                'ttl' => __('Return Address'),
                'txt' => [
                    __('Ship the item to the address provided along with the RA number.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('The cost of return shipping is the responsibility of the customer unless the return is due to an error on our part.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                ]
            ],
            [
                'ttl' => __('Refund Processing'),
                'txt' => __('Once we receive the returned item, we will inspect it and process the refund within 10 business days.', [
                    'hom' => route('views.guest.home'),
                    'pro' => route('views.guest.product'),
                ])
            ],
            [
                'ttl' => __('Payment Method'),
                'txt' => __('Refunds will be issued to the original payment method used for the purchase.', [
                    'hom' => route('views.guest.home'),
                    'pro' => route('views.guest.product'),
                ])
            ],
            [
                'ttl' => __('Shipping Costs'),
                'txt' => __('Original shipping costs are non-refundable unless the return is due to an error on our part.', [
                    'hom' => route('views.guest.home'),
                    'pro' => route('views.guest.product'),
                ])
            ],
        ];
        return view('guest.return', compact('list'));
    }

    public function privacy()
    {
        $list = [
            [
                'ttl' => __('Data Controller'),
                'txt' => [
                    __('Following consultation of this <a style="all: revert;" href=":hom">site</a>, data relating to identified or identifiable persons may be processed.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('The owner of their treatment is <a style="all: revert;" href=":hom">ITALMENARA</a>.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ])
                ]
            ],
            [
                'ttl' => __('Place of Data Processing'),
                'txt' =>
                __('The processing connected to the web services of this <a style="all: revert;" href=":hom">site</a> takes place at the (headquarters of the data processing managed on the web) and is handled only by internal technical personnel, or by persons in charge of occasional maintenance operations.', [
                    'hom' => route('views.guest.home'),
                    'pro' => route('views.guest.product'),
                ]),
            ],
            [
                'ttl' => __('Types of Data Processed'),
                'txt' => [
                    __('– Browsing data:'),
                    __('The computer systems and software procedures used to operate this <a style="all: revert;" href=":hom">website</a> acquire, during their normal operation, some personal data whose transmission is implicit in the use of Internet communication protocols. This is information that is not collected to be associated with identified interested parties, but which by its very nature could, through processing and association with data held by third parties, allow users to be identified. This category of data includes the IP addresses or domain names of the computers used by users who connect to the <a style="all: revert;" href=":hom">site</a>, the addresses in URI (Uniform Resource Identifier) notation of the requested resources, the time of the request, the method used in submitting the request to the server, the size of the file obtained in response, the numerical code indicating the status of the response given by the server (successful, error, etc.) and other parameters relating to the operating system and the user\\\'s IT environment. These data are used for the sole purpose of obtaining anonymous statistical information on the use of the <a style="all: revert;" href=":hom">site</a> and to check its correct functioning and are deleted immediately after processing.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('– Data provided voluntarily by the user:'),
                    __('The optional, explicit and voluntary sending of e-mails to the addresses indicated on this <a style="all: revert;" href=":hom">site</a> entails the subsequent acquisition of the sender\\\'s address, necessary to respond to requests, as well as any other personal data included in the message.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ])
                ]
            ],
            [
                'ttl' => __('Processing Methods'),
                'txt' => [
                    __('Personal data are processed with automated tools for the time strictly necessary to achieve the purposes for which they were collected.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('Specific security measures are observed to prevent data loss, illicit or incorrect use and unauthorized access.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                ]
            ],
            [
                'ttl' => __('Rights of Interested Parties'),
                'txt' => [
                    __('The subjects to whom the personal data refer have the right at any time to obtain confirmation of the existence or otherwise of the same data and to know its content and origin, verify its accuracy or request its integration or updating, or rectification pursuant to art. 7 of Legislative Decree 196/2003.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('Any request relating to the aforementioned policy should be forwarded at the email privacy@italmenara.com.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ])
                ]
            ],
            [
                'ttl' => __('Information And Acquisition of Consent For The Use of Cookies'),
                'txt' => [
                    __('The <a style="all: revert;" href=":hom">ITALMENARA</a> <a style="all: revert;" href=":hom">website</a> and/or each of its sections uses technical and third-party cookies to provide you with a personalized browsing experience.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('Cookies are text files that are sent from the server of the <a style="all: revert;" href=":hom">website</a> visited to the user\\\'s browser suitable for storing some information allowing us to identify registered users who are connected to our <a style="all: revert;" href=":hom">site</a>.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('Some cookies are used to perform computer authentication, session monitoring and memorization of specific information on users who access a web page.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('These cookies, so-called technical, are often useful, because they can make browsing and using the web quicker and quicker, because for example they intervene to facilitate certain procedures when you make online purchases, when you authenticate to restricted access areas or when a <a style="all: revert;" href=":hom">website</a> It automatically recognizes the language you usually use.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('A particular type of cookie, called analytics, is then used by <a style="all: revert;" href=":hom">website</a> managers to collect information, in aggregate form, on the number of users and how they visit the <a style="all: revert;" href=":hom">site</a> itself, and therefore develop general statistics on the service and its use.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('By continuing to use this <a style="all: revert;" href=":hom">site</a> you agree to our use of cookies.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('Below are the main cookies we use:'),
                    __('- Essential/Strictly Necessary Cookies: cookies used by us to make our <a style="all: revert;" href=":hom">site</a> work better, for example to remember your login details for some parts of the <a style="all: revert;" href=":hom">site</a>.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('- Performance Cookies: cookies that help us improve the performance of our <a style="all: revert;" href=":hom">site</a> by allowing us to measure the number of times a page is visited.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('- Functionality Cookies: cookies that help us store the settings you have selected so that we can remember your preferences during a subsequent visit.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('The use of these cookies is necessary to make it possible and/or facilitate user navigation within the <a style="all: revert;" href=":hom">site</a>. Therefore, please take note that restricting cookies may affect the functionality of this <a style="all: revert;" href=":hom">website</a>.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                    __('Please also note that our <a style="all: revert;" href=":hom">site</a> also uses services provided by other companies (for example, Google, Facebook, Twitter, Jwplayer) who set cookies on our behalf on this <a style="all: revert;" href=":hom">site</a> in order to provide the relevant services.', [
                        'hom' => route('views.guest.home'),
                        'pro' => route('views.guest.product'),
                    ]),
                ]
            ],
        ];
        return view('guest.privacy', compact('list'));
    }
}

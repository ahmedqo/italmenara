<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index_view(Request $Request)
    {
        $data = Product::with('Images')->with('Brand')->with('Category')->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search($Request->search);
        }
        $data = $data->cursorPaginate(50);
        return view('product.index', compact('data'));
    }

    public function store_view()
    {
        return view('product.store');
    }

    public function patch_view($id)
    {
        $data = Product::with('Images')->with('Brand')->with('Category')->findorfail($id);
        return view('product.patch', compact('data'));
    }

    public function search_action(Request $Request)
    {
        $data = Product::with('Images')->with('Brand')->with('Category')->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function store_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'name_en' => ['required', 'string', 'unique:products'],
            'name_fr' => ['required', 'string', 'unique:products'],
            'name_it' => ['required', 'string', 'unique:products'],
            'name_ar' => ['required', 'string', 'unique:products'],
            'status' => ['required', 'string'],
            'unit' => ['required', 'string'],
            'category' => ['required', 'integer'],
            'brand' => ['required', 'integer'],
            'images' => ['required', 'array'],
            'images.*' => ['required', 'image'],
            'price' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Product::create($Request->merge([
            'slug' =>  Str::slug($Request->name_en)
        ])->all());

        return Redirect::back()->with([
            'message' => __('Created successfully'),
            'type' => 'success'
        ]);
    }

    public function patch_action(Request $Request, $id)
    {
        $validator = Validator::make($Request->all(), [
            'name_en' => ['required', 'string', 'unique:products,name_en,' . $id],
            'name_fr' => ['required', 'string', 'unique:products,name_fr,' . $id],
            'name_it' => ['required', 'string', 'unique:products,name_it,' . $id],
            'name_ar' => ['required', 'string', 'unique:products,name_ar,' . $id],
            'status' => ['required', 'string'],
            'unit' => ['required', 'string'],
            'category' => ['required', 'integer'],
            'brand' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Product = Product::findorfail($id);

        if ($Request->deleted && !$Request->hasFile('images') && $Product->Images->count() == count($Request->deleted)) {
            return Redirect::back()->withInput()->with([
                'message' => __('The images field is required'),
                'type' => 'error'
            ]);
        }

        $Product->update($Request->merge([
            'slug' =>  Str::slug($Request->name_en)
        ])->all());

        if ($Request->hasFile('images')) {
            foreach ($Request->file('images') as $Image) {
                Image::$FILE = $Image;
                $Product->Images()->create();
            }
        }

        if ($Request->deleted) {
            foreach ($Request->deleted as $id) {
                Image::findorfail($id)->delete();
            }
        }

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }

    public function clear_action($id)
    {
        Product::findorfail($id)->delete();

        return Redirect::route('views.products.index')->with([
            'message' => __('Deleted successfully'),
            'type' => 'success'
        ]);
    }
}

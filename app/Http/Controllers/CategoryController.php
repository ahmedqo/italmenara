<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index_view(Request $Request)
    {
        $data = Category::with('Image')->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search($Request->search);
        }
        $data = $data->cursorPaginate(50);
        return view('category.index', compact('data'));
    }

    public function store_view()
    {
        return view('category.store');
    }

    public function patch_view($id)
    {
        $data = Category::findorfail($id);
        return view('category.patch', compact('data'));
    }

    public function search_action(Request $Request)
    {
        $data = Category::with('Image')->orderBy('id', 'DESC');
        if ($Request->search) {
            $data = $data->search(urldecode($Request->search));
        }
        $data = $data->cursorPaginate(50);
        return response()->json($data);
    }

    public function store_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'name_en' => ['required', 'string', 'unique:categories'],
            'name_fr' => ['required', 'string', 'unique:categories'],
            'name_it' => ['required', 'string', 'unique:categories'],
            'name_ar' => ['required', 'string', 'unique:categories'],
            'image' => ['required', 'image'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Category::create($Request->merge([
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
            'name_en' => ['required', 'string', 'unique:categories,name_en,' . $id],
            'name_fr' => ['required', 'string', 'unique:categories,name_fr,' . $id],
            'name_it' => ['required', 'string', 'unique:categories,name_it,' . $id],
            'name_ar' => ['required', 'string', 'unique:categories,name_ar,' . $id],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Category = Category::findorfail($id);
        $Category->update($Request->merge([
            'slug' =>  Str::slug($Request->name_en)
        ])->all());

        if ($Request->hasFile('image')) {
            Image::$FILE = $Request->file('image');
            $Category->Image->delete();
            $Category->Image()->create();
        }

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }

    public function clear_action($id)
    {
        Category::findorfail($id)->delete();

        return Redirect::route('views.categories.index')->with([
            'message' => __('Deleted successfully'),
            'type' => 'success'
        ]);
    }
}

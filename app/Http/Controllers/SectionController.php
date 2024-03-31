<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class SectionController extends Controller
{
    public function principal_view()
    {
        $data = Section::with('Images')->where('type', 'principal')->first();
        return view('section.principal', compact('data'));
    }

    public function business_view()
    {
        $data = Section::with('Images')->where('type', 'business')->first();
        return view('section.business', compact('data'));
    }

    public function shipping_view()
    {
        $data = Section::with('Images')->where('type', 'shipping')->first();
        return view('section.shipping', compact('data'));
    }

    public function principal_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'content_en' => ['required', 'string'],
            'content_fr' => ['required', 'string'],
            'content_it' => ['required', 'string'],
            'content_ar' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Section = Section::where('type', 'principal')->first();

        if (
            ($Request->deleted && !$Request->hasFile('images') && $Section->Images->count() == count($Request->deleted))
            || (!$Request->hasFile('images') && $Section->Images->count() == 0)
        ) {
            return Redirect::back()->withInput()->with([
                'message' => __('The images field is required'),
                'type' => 'error'
            ]);
        }

        $Section->update($Request->all());

        if ($Request->hasFile('images')) {
            foreach ($Request->file('images') as $Image) {
                Image::$FILE = $Image;
                $Section->Images()->create();
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

    public function business_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'content_en' => ['required', 'string'],
            'content_fr' => ['required', 'string'],
            'content_it' => ['required', 'string'],
            'content_ar' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Section = Section::where('type', 'business')->first();

        if (!$Request->hasFile('image') && $Section->Images->count() == 0) {
            return Redirect::back()->withInput()->with([
                'message' => __('The image field is required'),
                'type' => 'error'
            ]);
        }

        $Section->update($Request->all());

        if ($Request->hasFile('image')) {
            Image::$FILE = $Request->file('image');
            if ($Section->Images->count())
                $Section->Images[0]->delete();
            $Section->Images()->create();
        }

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }

    public function shipping_action(Request $Request)
    {
        $validator = Validator::make($Request->all(), [
            'content_en' => ['required', 'string'],
            'content_fr' => ['required', 'string'],
            'content_it' => ['required', 'string'],
            'content_ar' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $Section = Section::where('type', 'shipping')->first();

        if (!$Request->hasFile('image') && $Section->Images->count() == 0) {
            return Redirect::back()->withInput()->with([
                'message' => __('The image field is required'),
                'type' => 'error'
            ]);
        }

        $Section->update($Request->all());

        if ($Request->hasFile('image')) {
            Image::$FILE = $Request->file('image');
            if ($Section->Images->count())
                $Section->Images[0]->delete();
            $Section->Images()->create();
        }

        return Redirect::back()->with([
            'message' => __('Updated successfully'),
            'type' => 'success'
        ]);
    }
}

<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Spatie\Sitemap\Sitemap;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('sitemap:generate', function () {
    $sitemap = Sitemap::create()
        ->add(route('views.guest.home'))
        ->add(route('views.guest.brand'))
        ->add(route('views.guest.product'))
        ->add(route('views.guest.category'))
        ->add(route('views.guest.faq'))
        ->add(route('views.guest.return'))
        ->add(route('views.guest.term'))
        ->add(route('views.guest.privacy'))
        ->add(Brand::all())
        ->add(Category::all())
        ->add(Product::all())
        ->writeToFile(public_path('sitemap.xml'));
})->purpose('generate site map');

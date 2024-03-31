<?php

use App\Http\Controllers\CoreController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

Route::get('/language/{locale}', function ($locale) {
    app()->setlocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('actions.language.index');

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [CoreController::class, 'index_view'])->name('views.core.index');
    Route::get('/settings', [CoreController::class, 'setting_view'])->name('views.core.settings');
    Route::get('/data/charts', [CoreController::class, 'charts_action'])->name('actions.core.charts');
    Route::get('/mail/{type}/{id}', [CoreController::class, 'mail_action'])->name('actions.core.mail');
    Route::get('/data/sellers', [CoreController::class, 'sellers_action'])->name('actions.core.sellers');
    Route::get('/data/visitors', [CoreController::class, 'visitors_action'])->name('actions.core.visitors');

    Route::get('/sections/principal', [SectionController::class, 'principal_view'])->name('views.sections.principal');
    Route::get('/sections/business', [SectionController::class, 'business_view'])->name('views.sections.business');
    Route::get('/sections/shipping', [SectionController::class, 'shipping_view'])->name('views.sections.shipping');


    Route::patch('/settings', [CoreController::class, 'setting_action'])->name('actions.core.settings');
    Route::patch('/sections/principal', [SectionController::class, 'principal_action'])->name('actions.sections.principal');
    Route::patch('/sections/business', [SectionController::class, 'business_action'])->name('actions.sections.business');
    Route::patch('/sections/shipping', [SectionController::class, 'shipping_action'])->name('actions.sections.shipping');
});

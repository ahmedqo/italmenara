<?php

use App\Http\Controllers\QuotationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/quotations', [QuotationController::class, 'index_view'])->name('views.quotations.index');
    Route::get('/quotations/store', [QuotationController::class, 'store_view'])->name('views.quotations.store');
    Route::get('/quotations/{id}/patch', [QuotationController::class, 'patch_view'])->name('views.quotations.patch');
    Route::get('/quotations/{id}/scene', [QuotationController::class, 'scene_view'])->name('views.quotations.scene');

    Route::post('/quotations/store', [QuotationController::class, 'store_action'])->name('actions.quotations.store');
    Route::get('/quotations/search', [QuotationController::class, 'search_action'])->name('actions.quotations.search');
    Route::patch('/quotations/{id}/patch', [QuotationController::class, 'patch_action'])->name('actions.quotations.patch');
    Route::delete('/quotations/{id}/clear', [QuotationController::class, 'clear_action'])->name('actions.quotations.clear');
});

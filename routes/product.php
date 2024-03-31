<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/products', [ProductController::class, 'index_view'])->name('views.products.index');
    Route::get('/products/store', [ProductController::class, 'store_view'])->name('views.products.store');
    Route::get('/products/{id}/patch', [ProductController::class, 'patch_view'])->name('views.products.patch');

    Route::post('/products/store', [ProductController::class, 'store_action'])->name('actions.products.store');
    Route::get('/products/search', [ProductController::class, 'search_action'])->name('actions.products.search');
    Route::patch('/products/{id}/patch', [ProductController::class, 'patch_action'])->name('actions.products.patch');
    Route::delete('/products/{id}/clear', [ProductController::class, 'clear_action'])->name('actions.products.clear');
});

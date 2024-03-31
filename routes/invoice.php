<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/invoices', [InvoiceController::class, 'index_view'])->name('views.invoices.index');
    Route::get('/invoices/store', [InvoiceController::class, 'store_view'])->name('views.invoices.store');
    Route::get('/invoices/{id}/patch', [InvoiceController::class, 'patch_view'])->name('views.invoices.patch');
    Route::get('/invoices/{id}/scene', [InvoiceController::class, 'scene_view'])->name('views.invoices.scene');

    Route::post('/invoices/store', [InvoiceController::class, 'store_action'])->name('actions.invoices.store');
    Route::get('/invoices/search', [InvoiceController::class, 'search_action'])->name('actions.invoices.search');
    Route::patch('/invoices/{id}/patch', [InvoiceController::class, 'patch_action'])->name('actions.invoices.patch');
    Route::delete('/invoices/{id}/clear', [InvoiceController::class, 'clear_action'])->name('actions.invoices.clear');
});

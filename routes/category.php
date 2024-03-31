<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/categories', [CategoryController::class, 'index_view'])->name('views.categories.index');
    Route::get('/categories/store', [CategoryController::class, 'store_view'])->name('views.categories.store');
    Route::get('/categories/{id}/patch', [CategoryController::class, 'patch_view'])->name('views.categories.patch');

    Route::post('/categories/store', [CategoryController::class, 'store_action'])->name('actions.categories.store');
    Route::get('/categories/search', [CategoryController::class, 'search_action'])->name('actions.categories.search');
    Route::patch('/categories/{id}/patch', [CategoryController::class, 'patch_action'])->name('actions.categories.patch');
    Route::delete('/categories/{id}/clear', [CategoryController::class, 'clear_action'])->name('actions.categories.clear');
});

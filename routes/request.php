<?php

use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/requests', [RequestController::class, 'index_view'])->name('views.requests.index');
    Route::get('/requests/{id}/scene', [RequestController::class, 'scene_view'])->name('views.requests.scene');

    Route::get('/requests/search', [RequestController::class, 'search_action'])->name('actions.requests.search');
    Route::delete('/requests/{id}/clear', [RequestController::class, 'clear_action'])->name('actions.requests.clear');
});

<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'home'])->name('views.guest.home');
Route::get('/brands', [GuestController::class, 'brand'])->name('views.guest.brand');
Route::get('/products', [GuestController::class, 'product'])->name('views.guest.product');
Route::get('/products/details/{slug}', [GuestController::class, 'show'])->name('views.guest.show');
Route::get('/categories', [GuestController::class, 'category'])->name('views.guest.category');
Route::get('/requests/details', [GuestController::class, 'request'])->name('views.guest.request');
Route::get('/products/search', [GuestController::class, 'search'])->name('views.guest.search');
Route::get('/quotations/preview/{id}', [GuestController::class, 'quotation'])->name('views.guest.quotation');
Route::get('/invoices/preview/{id}', [GuestController::class, 'invoice'])->name('views.guest.invoice');

Route::post('/contact', [GuestController::class, 'contact'])->name('actions.guest.contact');
Route::post('/requests/details', [RequestController::class, 'store_action'])->name('actions.guest.request');

Route::get('/faqs', [GuestController::class, 'faq'])->name('views.guest.faq');
Route::get('/return_policy', [GuestController::class, 'return'])->name('views.guest.return');
Route::get('/terms_and_conditions', [GuestController::class, 'term'])->name('views.guest.term');
Route::get('/privacy_policy', [GuestController::class, 'privacy'])->name('views.guest.privacy');

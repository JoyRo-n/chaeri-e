<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatchaController;
use App\Http\Controllers\WebsiteInquiryController;

Route::get('/', [MatchaController::class, 'index'])->name('home');

Route::post('/api/orders', [MatchaController::class, 'storeOrder'])->name('orders.store');

Route::post('/inquiries', [WebsiteInquiryController::class, 'store'])->name('inquiries.store');

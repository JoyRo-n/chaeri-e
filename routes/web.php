<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatchaController;

Route::get('/', [MatchaController::class, 'index'])->name('home');

Route::post('/api/orders', [MatchaController::class, 'storeOrder'])->name('orders.store');

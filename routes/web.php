<?php

use App\Http\Controllers\BobcatProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BobcatProductController::class, 'index'])->name('home');

Route::get('/tipo-de-llanta/{type}', [BobcatProductController::class, 'type'])
    ->whereIn('type', ['neumatica', 'solida'])
    ->name('tire-type.show');

Route::get('/producto/{slug}', [BobcatProductController::class, 'show'])
    ->name('products.show');

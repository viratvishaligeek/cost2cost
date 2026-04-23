<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use Illuminate\Support\Facades\Route;

// Admin Routes group
include 'admin.php';

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/contact', 'contact')->name('contact');
});

Route::controller(ProductController::class)->name('product')->as('product.')->group(function () {
    Route::get('/{slug}', 'showDetail')->name('show');
});

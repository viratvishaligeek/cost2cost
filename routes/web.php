<?php

use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

// Admin Routes group
include 'admin.php';

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'home')->name('home');
});

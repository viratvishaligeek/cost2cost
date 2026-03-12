<?php

use App\Http\Controllers\Backend\Auth\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

// Auth routes

Route::prefix('admin')->as('admin.')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'login')->name('login');
        Route::post('try-login', 'tryLogin')->name('try_login');
        Route::get('forgot-password', 'forgotPassword')->name('forgot_password');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::controller(DashboardController::class)->group(function () {
            Route::get('dashboard', 'dashboard')->name('dashboard');
        });
    });
});

<?php

use App\Http\Controllers\Backend\AdvanceModule\RoleController;
use App\Http\Controllers\Backend\AdvanceModule\TeamController;
use App\Http\Controllers\Backend\AdvanceModule\TenantController;
use App\Http\Controllers\Backend\Auth\AuthController;
use App\Http\Controllers\Backend\Blogger\BlogController;
use App\Http\Controllers\Backend\Blogger\BlogCategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SettingController;
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
            Route::get('clear-cache', 'clearCache')->name('clear_cache');
            Route::post('update-active-tenant', 'updateActiveTenant')->name('update_active_tenant');
            Route::get('logout', 'logout')->name('logout');
        });

        // advance module routes
        Route::resource('tenant', TenantController::class);
        Route::resource('team', TeamController::class);
        Route::resource('role', RoleController::class);

        // advance module routes
        Route::resource('setting', SettingController::class);

        // advance module routes
        Route::resource('blog-category', BlogCategoryController::class);
        Route::resource('blog', BlogController::class);
    });

    // ------------- laravel file manager
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth:admin']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

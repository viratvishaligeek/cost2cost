<?php

use App\Http\Controllers\Backend\AdvanceModule\RoleController;
use App\Http\Controllers\Backend\AdvanceModule\TeamController;
use App\Http\Controllers\Backend\AdvanceModule\TenantController;
use App\Http\Controllers\Backend\Auth\AuthController;
use App\Http\Controllers\Backend\Blogger\BlogCategoryController;
use App\Http\Controllers\Backend\Blogger\BlogController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Product\BrandController;
use App\Http\Controllers\Backend\Product\CategoryController;
use App\Http\Controllers\Backend\Product\OptionController;
use App\Http\Controllers\Backend\Product\OptionValueController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\Product\VariantController;
use App\Http\Controllers\Backend\SettingController;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

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

        // setting module routes
        Route::resource('setting', SettingController::class);

        // blogging module routes
        Route::resource('blog-category', BlogCategoryController::class);
        Route::resource('blog', BlogController::class);

        // product module routes
        Route::resource('brand', BrandController::class);
        Route::resource('category', CategoryController::class);
        Route::get('product/get-subcategories/{id}', [CategoryController::class, 'getSubCategories'])->name('product.get-subcategories');
        Route::resource('options', OptionController::class);
        Route::post('options/get-values', [OptionController::class, 'getOptionValues'])->name('options.get-values');
        Route::resource('option-value', OptionValueController::class);
        Route::resource('product', ProductController::class);
        Route::get('product/get-faqs/{id}', [ProductController::class, 'getFaqs'])->name('product.get-faqs');
        Route::post('product/update-faqs/{id}', [ProductController::class, 'getVariants'])->name('product.update-faqs');
        Route::resource('variant', VariantController::class);
    });

    // ------------- laravel file manager
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth:admin']], function () {
        Lfm::routes();
    });
    Route::get('admin/file-manager', function () {
        return view('backend.filemanager');
    })->name('laravel-filemanager');
});

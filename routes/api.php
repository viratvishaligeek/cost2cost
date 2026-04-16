<?php

use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\Api\BlogCatApiController;
use App\Http\Controllers\Api\ContactFormApiController;
use App\Http\Controllers\Api\ProductApiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'v1.', 'middleware' => ['tenant']], function () {
    Route::controller(BlogCatApiController::class)->group(function () {
        Route::get('/blog-category', 'index');
    });
    Route::controller(BlogApiController::class)->group(function () {
        Route::get('blogs', 'index');
        Route::get('blog/{slug}', 'blogDetail');
        Route::get('category/{id}', 'categoryBlog');
    });
    Route::controller(ContactFormApiController::class)->group(function () {
        Route::post('form-submit', 'formSubmit');
    });
    Route::controller(ProductApiController::class)->group(function () {
        Route::get('featured-products', 'featuredProducts');
        Route::get('top-products', 'topProducts');
        Route::get('recent-products', 'recentProducts');
        Route::get('category', 'category');
        Route::get('category/{id}', 'categoryProducts');
        Route::get('search/{query}', 'search');
        Route::get('products', 'productList');
        Route::get('product/{slug}', 'productDetail');
    });
});

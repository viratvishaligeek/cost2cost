<?php

use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\Api\BlogCatApiController;
use App\Http\Controllers\Api\ContactFormApiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'v1.', 'middleware' => ['tenant']], function () {
    Route::controller(BlogCatApiController::class)->group(function () {
        Route::get('/blog-category', 'index');
    });
    Route::controller(BlogApiController::class)->group(function () {
        Route::get('blogs', 'index');
        Route::get('category/{id}', 'categoryBlog');
    });
    Route::controller(ContactFormApiController::class)->group(function () {
        Route::post('form-submit', 'formSubmit');
    });
});

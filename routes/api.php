<?php

use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\Api\BlogCatApiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'v1.'], function () {
    Route::controller(BlogCatApiController::class)->group(function () {
        Route::get('/blog-category', 'index');
    });
    Route::controller(BlogApiController::class)->group(function () {
        Route::get('blogs', 'index');
    });
});

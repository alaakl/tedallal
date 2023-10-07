<?php

use App\Http\Controllers\Categorization\CategoryController;
use App\Http\Controllers\Categorization\ProductController;
use App\Http\Controllers\Categorization\StoreController;
use App\Http\Controllers\Categorization\StoreSearchController;
use App\Http\Controllers\Categorization\TypeController;
use Illuminate\Support\Facades\Route;

Route::middleware('verified')->group(function () {

    Route::prefix('store')->middleware('auth:api')->group(function () {
        Route::get('/', [StoreController::class, 'index']);
        Route::get('/get-top-stores', [StoreController::class, 'getTopRatedStores']);
        Route::get('/get-recommended-stores', [StoreController::class, 'getRecommendedStores']);
        Route::get('/{store}', [StoreController::class, 'show']);
        Route::post('add-rating/{store}', [StoreController::class, 'addRating']);
        Route::get('/get-ratings/{store}', [StoreController::class, 'getRatings']);
    });

    Route::prefix('category')->middleware('auth:api')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/{category}', [CategoryController::class, 'show']);
    });

    Route::prefix('type')->middleware('auth:api')->group(function () {
        Route::get('/{searchByName}', [TypeController::class, 'index']);
        Route::get('/{type}', [TypeController::class, 'show']);
    });

    Route::prefix('product')->middleware('auth:api')->group(function () {
        Route::get('/get-ratings/{product}', [ProductController::class, 'getRatings']);
        Route::get('/{product}', [ProductController::class, 'show']);
        Route::post('add-rating/{product}', [ProductController::class, 'addRating']);
    });

});






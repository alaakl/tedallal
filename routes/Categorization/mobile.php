<?php

use App\Http\Controllers\Categorization\ProductController;
use App\Http\Controllers\Categorization\StoreSearchController;
use App\Http\Controllers\Favourites\FavouritController;
use App\Http\Controllers\Payment\BillingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'verified'])->group(function () {

    Route::prefix('first-service')->group(function () {
        Route::post('filter', [StoreSearchController::class, 'filterBy']);
        Route::post('search', [StoreSearchController::class, 'search']);
    });

    Route::post('/buy-products', [BillingController::class, 'buyProducts']);

    Route::prefix('favourites')->group(function () {
        Route::get('/', [FavouritController::class, 'index']);
        Route::post('/{product}', [FavouritController::class, 'store']);
        Route::delete('/{favourit}', [FavouritController::class, 'destroy']);
    });
});





Route::get('get-most-popular', [\App\Http\Controllers\Categorization\ProductController::class, 'getMostPopularProducts']);

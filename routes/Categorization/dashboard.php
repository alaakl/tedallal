<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Categorization\CategoryController;
use App\Http\Controllers\Categorization\ProductController;
use App\Http\Controllers\Categorization\StoreController;
use App\Http\Controllers\Categorization\TypeController;
use App\Http\Controllers\Payment\BillingController;
use Illuminate\Support\Facades\Route;

Route::middleware('verified')->group(function () {

    Route::prefix('store')->middleware(['auth:api','CheckHasRole:root|admin'])->group(function () {
        Route::post('/', [StoreController::class, 'store']);
        Route::put('/{store}', [StoreController::class, 'update']);
        Route::delete('/{store}', [StoreController::class, 'destroy']);
    });


    Route::prefix('category')->middleware(['auth:api','CheckHasRole:root|admin'])->group(function () {
        Route::post('/{store}', [CategoryController::class, 'store']);
        Route::put('/{category}', [CategoryController::class, 'update']);
        Route::delete('/{category}', [CategoryController::class, 'destroy']);
    });


    Route::prefix('type')->middleware(['auth:api','CheckHasRole:root|admin'])->group(function () {
        Route::post('/{category}', [TypeController::class, 'store']);
        Route::put('/{type}', [TypeController::class, 'update']);
        Route::delete('/{type}', [TypeController::class, 'destroy']);
    });

    Route::prefix('product')->middleware(['auth:api','CheckHasRole:root|admin'])->group(function () {
        Route::post('/{type}', [ProductController::class, 'store']);
        Route::put('/{product}', [ProductController::class, 'update']);
        Route::delete('/{product}', [ProductController::class, 'destroy']);
    });

    Route::post('add-store-owner', [RegisterController::class ,'createDashboardAccount'])->middleware(['auth:api','CheckHasRole:root|admin']);
    Route::post('add-dashboard', [RegisterController::class ,'createDashboardAccount'])->middleware(['auth:api','CheckHasRole:root|admin']);
    Route::post('add-admin', [RegisterController::class ,'createAdminAccount'])->middleware(['auth:api','CheckHasRole:root']);

    Route::prefix('billing')->group(function (){
        Route::delete('/{billing}', [BillingController::class, 'deleteBilling'])->middleware(['auth:api','CheckHasRole:root|admin']);
        Route::post('/reject/{billing}', [BillingController::class, 'rejectBilling'])->middleware(['auth:api','CheckHasRole:root|admin']);
    });
});




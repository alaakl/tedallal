<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OptCodeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LightDelivery\LightDeliveryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('verified')->group(function () {

    Route::post('make-user-activate-unactivate/{user}',  [RegisterController::class ,'activationUserAccount'])
        ->middleware(['auth:api','CheckHasRole:root|admin']);
    Route::get('get-all-client', [RegisterController::class , 'getAllClient'])
        ->middleware(['auth:api','CheckHasRole:root|admin|dashboard']);


    Route::prefix('addresses')->middleware('auth:api')->group(function () {
        Route::get('/get-addresses', [AddressController::class, 'index']);
        Route::post('/add-address', [AddressController::class, 'store']);
    });

});


Route::prefix('auth')->group(function () {
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:api');
    Route::post('update_profile', [LoginController::class, 'update_profile'])->middleware(['auth:api', 'verified']);
});


Route::post('forget-password', [ForgetPasswordController::class ,'forgetPassword']);
Route::post('check-reset-code', [ForgetPasswordController::class ,'checkCodeForReset']);
Route::post('reset-password', [ForgetPasswordController::class ,'resetPassword']);
Route::post('refreshtoken',  [LoginController::class ,'refreshToken']);

Route::prefix('code')->middleware(['auth:api', 'throttle:6,1'])->group(function () {
    Route::get('/resend', [OptCodeController::class, 'codeUpdate']);
    Route::post('/check', [OptCodeController::class, 'codeVerification']);
});



Route::prefix('light-delivery')->middleware('auth:api')->group(function () {
    Route::post('/store-item', [LightDeliveryController::class, 'storeDelivery']);
    Route::delete('/{item}', [LightDeliveryController::class, 'deleteDelivery']);
});

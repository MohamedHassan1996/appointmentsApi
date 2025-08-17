<?php

use App\Http\Controllers\Api\V1\Auth\AuthLoginController;
use App\Http\Controllers\Api\V1\Auth\AuthLogoutController;
use App\Http\Controllers\Api\V1\Auth\ForgetPasswordOtpController;
use App\Http\Controllers\Api\V1\Otp\OtpController;
use App\Http\Controllers\Api\V1\Select\SelectController;
use Illuminate\Support\Facades\Route;

Route::middleware(['checkLocale'])->prefix('v1/{locale}')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', AuthLoginController::class);
        Route::post('logout', AuthLogoutController::class);
    });

    Route::prefix('auth/otp-forget-password')->group(function () {
        Route::post('', [ForgetPasswordOtpController::class, 'store']);
        Route::put('', [ForgetPasswordOtpController::class, 'update']);
    });

    Route::prefix('otp')->group(function () {
        Route::get('verify', [OtpController::class, 'verify']);
    });

    Route::prefix('selects')->group(function(){
        Route::get('', [SelectController::class, 'getSelects']);
    });



});

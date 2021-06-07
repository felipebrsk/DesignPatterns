<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('v1/auth/login', [AuthController::class, 'login'])->name('login');

Route::group(['prefix' => 'v1', 'middleware' => 'apiJWT'], function() {
    Route::prefix('users')->group(function() {
        Route::apiResource('/', UserController::class);
    });

    // Auth group API section
    Route::prefix('auth')->group(function(){
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
    });
});

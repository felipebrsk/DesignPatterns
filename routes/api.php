<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('v1/auth/login', [AuthController::class, 'login'])->name('login');

Route::group(['prefix' => 'v1'], function() {
    Route::prefix('users')->group(function() {
        Route::apiResource('/', UserController::class);
    });

    // Auth group API section
    Route::prefix('auth')->group(function(){
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
        Route::post('me', [AuthController::class, 'me'])->name('me');
    });
});

<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('v1/auth/login', [AuthController::class, 'login'])->name('login');

Route::prefix('v1')->group(function() {
    Route::apiResource('users', UserController::class);

    // Auth group API section
    Route::prefix('auth')->group(function(){
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
        Route::post('me', [AuthController::class, 'me'])->name('me');
    });
});

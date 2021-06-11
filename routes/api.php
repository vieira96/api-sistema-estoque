<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function (){
        Route::post('login', [AuthController::class, 'login']);
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });
    Route::post('register', [UserController::class, 'register']);

    Route::apiResource('/products', ProductController::class);

    Route::prefix('product')->group(function() {
        Route::post('/search', [ProductController::class, 'search']);
    });
});

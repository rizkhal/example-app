<?php

use App\Http\Controllers\Api\AuthJsonController;
use App\Http\Controllers\ShoppingJsonController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthJsonController::class)->prefix('users')->group(function () {
    Route::get('/', 'users');
    Route::post('/signup', 'signup');
    Route::post('/signin', 'signin');
});

Route::controller(ShoppingJsonController::class)->middleware('auth:api')->prefix('shopping')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{shopping}', 'show');
});

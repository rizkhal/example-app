<?php

use App\Http\Controllers\Api\AuthJsonController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthJsonController::class)->prefix('users')->group(function () {
    Route::get('/', 'users');
    Route::post('/signup', 'signup');
    Route::post('/signin', 'signin');
});

<?php

declare(strict_types=1);

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::post('register', RegisterController::class);
    Route::post('login', LoginController::class);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', LogoutController::class);
});

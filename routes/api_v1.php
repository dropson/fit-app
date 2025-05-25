<?php

declare(strict_types=1);

use App\Http\Controllers\API\V1\ExerciseController;
use App\Http\Resources\V1\ClientResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // Exercises
    Route::apiResource('/exercises', ExerciseController::class);
    // Client
    Route::prefix('fit')->middleware(['role:client'])->group(function () {


        // Profile
        Route::get('/user', function (Request $request) {
            return new ClientResource($request->user());
        });
    });

    // Coach
    Route::prefix('train')->group(function () {});
});

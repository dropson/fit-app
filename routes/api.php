<?php

declare(strict_types=1);

use App\Http\Resources\V1\ClientResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return new ClientResource($request->user());
})->middleware('auth:sanctum');

require __DIR__.'/auth.php';

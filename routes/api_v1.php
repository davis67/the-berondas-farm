<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\RabbitController;
use App\Http\Controllers\Api\V1\Auth\LoginController;

Route::post('/login', [LoginController::class, 'index']);

Route::middleware('auth:sanctum')->group(
    function () {
        Route::get('/rabbits', [RabbitController::class, 'index']);
    }
);

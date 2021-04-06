<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RabbitController;
use App\Http\Controllers\ApiAuth\LoginController;

Route::post('/login', LoginController::class);

Route::middleware('auth:sanctum')->group(
    function () {
        Route::get('/rabbits', [RabbitController::class, 'index']);
    }
);

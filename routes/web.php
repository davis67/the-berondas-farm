<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\Dashboard\Dashboard;
use App\Http\Livewire\Farm\RegisterFarm;
use App\Http\Livewire\Farm\ViewFarms;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');

    Route::get('register', Register::class)->name('register');

    Route::get('farm/register', RegisterFarm::class)->name('farm.create');
    Route::get('farms', ViewFarms::class)->name('farms.index');
});

Route::get('password/reset', Email::class)->name('password.request');

Route::get('password/reset/{token}', Reset::class)->name('password.reset');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::get('/', Dashboard::class)->name('home');

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});

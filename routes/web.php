<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Farm\EditFarm;
use App\Http\Livewire\Batch\AddBatch;
use App\Http\Livewire\Farm\ViewFarms;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Batch\ViewBatches;
use App\Http\Livewire\Farm\RegisterFarm;
use App\Http\Livewire\Dashboard\Dashboard;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\EmailVerificationController;

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');

    Route::get('register', Register::class)->name('register');
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

Route::middleware('auth')->group(function () {
    Route::get('/', Dashboard::class)->name('home');
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');
    Route::post('logout', LogoutController::class)->name('logout');

    Route::get('farm/register', RegisterFarm::class)->name('farm.create');
    Route::get('farms', ViewFarms::class)->name('farms.index');
    Route::get('farms/{farm}', EditFarm::class)->name('farms.edit');

    Route::get('batches/create', AddBatch::class)->name('batches.create');
    Route::get('batches', ViewBatches::class)->name('batches.index');
});

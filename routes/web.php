<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Cage\ShowCage;
use App\Http\Livewire\Farm\EditFarm;
use App\Http\Livewire\Batch\AddBatch;
use App\Http\Livewire\Farm\ViewFarms;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Batch\ShowBatch;
use App\Http\Livewire\Rabbit\AddRabbit;
use App\Http\Livewire\Batch\ViewBatches;
use App\Http\Livewire\Farm\RegisterFarm;
use App\Http\Livewire\Rabbit\ServeRabbit;
use App\Http\Livewire\Dashboard\Dashboard;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Expense\ViewExpenses;
use App\Http\Livewire\Rabbit\EditBreedTypes;
use App\Http\Livewire\Rabbit\ViewBreedTypes;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Expense\EditExpenseTypes;
use App\Http\Livewire\Expense\RegisterExpenses;
use App\Http\Livewire\Expense\ViewExpenseTypes;
use App\Http\Livewire\Rabbit\RegisterBreedTypes;
use App\Http\Livewire\Expense\CreateExpenseTypes;
use App\Http\Livewire\Rabbit\RegisterRabbitsBirth;
use App\Http\Controllers\Auth\EmailVerificationController;

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
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
    Route::get('register', Register::class)->name('register');

    Route::get('/', Dashboard::class)->name('home');
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');
    Route::post('logout', LogoutController::class)->name('logout');

    Route::get('farm/register', RegisterFarm::class)->name('farm.create');
    Route::get('farms', ViewFarms::class)->name('farms.index');
    Route::get('farms/{farm}', EditFarm::class)->name('farms.edit');
    Route::get('farms/{farm}/rabbit-transfer', ServeRabbit::class)->name('farms.rabbits');

    Route::get('batches/create', AddBatch::class)->name('batches.create');
    Route::get('batches', ViewBatches::class)->name('batches.index');
    Route::get('batches/{batch}', ShowBatch::class)->name('batches.show');

    Route::get('rabbits/create', AddRabbit::class)->name('rabbits.create');
    Route::get('rabbits/servicing/{service}/register-rabbit-birth', RegisterRabbitsBirth::class)->name('rabbits.register-birth');
    Route::get('breed-types/create', RegisterBreedTypes::class)->name('breed-types.create');
    Route::get('breed-types/index', ViewBreedTypes::class)->name('breed-types.index');
    Route::get('breed-types/{breedType}/edit', EditBreedTypes::class)->name('breed-types.edit');

    Route::get('cages/{cage}', ShowCage::class)->name('cages.show');

    Route::get('expenses/create', RegisterExpenses::class)->name('expenses.create');
    Route::get('expenses', ViewExpenses::class)->name('expenses.index');
    Route::get('expense-types/create', CreateExpenseTypes::class)->name('expense-types.create');
    Route::get('expense-types/index', ViewExpenseTypes::class)->name('expense-types.index');
    Route::get('expense-types/{expenseType}/edit', EditExpenseTypes::class)->name('expense-types.edit');
});

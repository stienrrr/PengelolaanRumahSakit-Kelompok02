<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/registration', [AuthController::class, 'registration'])->name('registration');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('users')->group(function () {
        Route::get('/admin', [UserController::class, 'adminIndex'])->name('users.admin');

        Route::get('/patient', [UserController::class, 'patientIndex'])->name('users.patient');
        Route::get('/patient/create', [UserController::class, 'patientCreate'])->name('users.patient.create');
        Route::post('/patient/store', [UserController::class, 'patientStore'])->name('users.patient.store');
        Route::get('/patient/{user}/edit', [UserController::class, 'patientEdit'])->name('users.patient.edit');
        Route::put('/patient/{user}/update', [UserController::class, 'patientUpdate'])->name('users.patient.update');
        Route::delete('/patient/{user}/destroy', [UserController::class, 'patientDestroy'])->name('users.patient.destroy');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

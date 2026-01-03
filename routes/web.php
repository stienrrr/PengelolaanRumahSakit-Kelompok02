<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/registration', [AuthController::class, 'registration'])->name('registration');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('users')->group(function () {
        Route::get('/admin', function () {
            return view('cms.user.admin.index');
        })->name('users.admin');

        Route::get('/patient', function () {
            return view('cms.user.patient.index');
        })->name('users.patient');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

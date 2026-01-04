<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/registration', [AuthController::class, 'registration'])->name('registration');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('medicalrecords', MedicalRecordController::class);

    Route::resource('registrations', RegistrationController::class);
    Route::put('/registrations/{registration}/status', [RegistrationController::class, 'status'])->name('registrations.status');

    Route::resource('medicines', MedicineController::class);

    Route::prefix('doctors')->group(function () {
        Route::get('/list', [DoctorController::class, 'doctorList'])->name('doctors.list');
        Route::get('/list/{user}/edit', [DoctorController::class, 'doctorTitleEdit'])->name('doctors.list.edit');
        Route::put('/list/{user}/update', [DoctorController::class, 'doctorTitleUpdate'])->name('doctors.list.update');

        Route::get('/schedule', [DoctorController::class, 'doctorSchedule'])->name('doctors.schedule');
        Route::get('/schedule/create', [DoctorController::class, 'doctorScheduleCreate'])->name('doctors.schedule.create');
        Route::post('/schedule/store', [DoctorController::class, 'doctorScheduleStore'])->name('doctors.schedule.store');
        Route::get('/schedule/{schedule}/edit', [DoctorController::class, 'doctorScheduleEdit'])->name('doctors.schedule.edit');
        Route::put('/schedule/{schedule}/update', [DoctorController::class, 'doctorScheduleUpdate'])->name('doctors.schedule.update');
        Route::delete('/schedule/{schedule}/destroy', [DoctorController::class, 'doctorScheduleDelete'])->name('doctors.schedule.destroy');
    });

    Route::prefix('users')->group(function () {
        Route::get('/admin', [UserController::class, 'adminIndex'])->name('users.admin');
        Route::get('/admin/create', [UserController::class, 'adminCreate'])->name('users.admin.create');
        Route::post('/admin/store', [UserController::class, 'adminStore'])->name('users.admin.store');
        Route::get('/admin/{user}/edit', [UserController::class, 'adminEdit'])->name('users.admin.edit');
        Route::put('/admin/{user}/update', [UserController::class, 'adminUpdate'])->name('users.admin.update');
        Route::delete('/admin/{user}/destroy', [UserController::class, 'adminDestroy'])->name('users.admin.destroy');

        Route::get('/patient', [UserController::class, 'patientIndex'])->name('users.patient');
        Route::get('/patient/create', [UserController::class, 'patientCreate'])->name('users.patient.create');
        Route::post('/patient/store', [UserController::class, 'patientStore'])->name('users.patient.store');
        Route::get('/patient/{user}/edit', [UserController::class, 'patientEdit'])->name('users.patient.edit');
        Route::put('/patient/{user}/update', [UserController::class, 'patientUpdate'])->name('users.patient.update');
        Route::delete('/patient/{user}/destroy', [UserController::class, 'patientDestroy'])->name('users.patient.destroy');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

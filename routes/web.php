<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DentistController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TreatmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => to_route('dashboard'));
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('patients', PatientController::class);
Route::resource('dentists', DentistController::class);
Route::resource('appointments', AppointmentController::class);
Route::resource('treatments', TreatmentController::class);
Route::resource('payments', PaymentController::class);

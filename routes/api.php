<?php

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\VaccineCenterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegistrationController::class, 'userRegister']);
Route::get('/vaccine-center', [VaccineCenterController::class, 'index']);
Route::get('/search', [RegistrationController::class, 'vaccinationRegistrationSearch']);


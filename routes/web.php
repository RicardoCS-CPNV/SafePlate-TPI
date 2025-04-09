<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

// Register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store']);

// Login

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');

Route::post('/login', [AuthController::class, 'login']);
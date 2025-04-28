<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllergenController;
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
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');

//Allergens
Route::prefix('/admin')->name('admin.')->middleware('isAdmin')->controller(AdminController::class)->group(function() {
    Route::get('/', 'index')->name('menu');
    Route::prefix('/allergenes')->name('allergenes.')->controller(AllergenController::class)->group(function() {
        Route::get('/', 'index')->name('menu');
        Route::post('/', 'store')->name('store');
    });
});
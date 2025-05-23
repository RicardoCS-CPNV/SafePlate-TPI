<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AllergenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DishViewController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [DashboardController::class, 'home'])->name('home');

// Register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store']);

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Allergens
Route::prefix('/admin')->name('admin.')->middleware('isAdmin')->controller(DashboardController::class)->group(function() {
    Route::get('/', 'admin')->name('menu');
    // Allergens
    Route::prefix('/allergenes')->name('allergenes.')->controller(AllergenController::class)->group(function() {
        Route::get('/', 'index')->name('menu');
        Route::post('/', 'store')->name('store');
        Route::put('/{allergene}', 'update')->name('update');
        Route::delete('/{allergene}', 'destroy')->name('destroy');
    });
    // Dishes
    Route::prefix('/dishes')->name('dishes.')->controller(DishController::class)->group(function() {
        Route::get('/', 'index')->name('menu');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{dish}', 'edit')->name('edit');
        Route::put('/{dish}', 'update')->name('update');
        Route::delete('/{dish}', 'destroy')->name('destroy');
        Route::delete('/images/{image}', 'destroyImage')->name('destroyImage');
    });
    Route::prefix('/users')->name('users.')->controller(AdminUserController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::put('/{user}', 'update')->name('update');
        Route::delete('/{user}', 'destroy')->name('destroy');
    });
});

// User Profile
Route::prefix('/profile')->name('profile.')->controller(AuthController::class)->group(function() {
    Route::get('/', 'edit')->name('edit')->middleware('isAuth');
    Route::post('/', 'update')->name('update')->middleware('isAuth');
});

// Show Dishes
Route::prefix('/dishes')->name('dishes.')->controller(DishViewController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/search', 'search')->name('search');
    Route::get('/{dish}', 'show')->name('show');
});

// Cart
Route::prefix('/cart')->name('cart.')->controller(CartController::class)->middleware('isAuth')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::put('/{cartItem}', 'update')->name('update');
    Route::delete('/{cartItem}', 'destroy')->name('destroy');
    Route::delete('/', 'clear')->name('clear');
});

// Orders
Route::prefix('/orders')->name('orders.')->controller(OrderController::class)->middleware('isAuth')->group(function () {
    Route::get('/orders', 'index')->name('index');
    Route::post('/orders', 'store')->name('store');
});
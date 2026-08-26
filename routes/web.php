<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\LandingPageController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\AdminController;

// Public routes
Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/armada', [LandingPageController::class, 'cars'])->name('cars.index');
Route::get('/armada/{id}', [LandingPageController::class, 'carDetail'])->name('cars.show');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Customer Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/booking', fn () => view('booking'))->name('booking');
    Route::get('/booking/{id}', fn () => view('booking.detail'))->name('booking.detail');
});

// Admin Panel routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Cars Management
    Route::get('/cars', [AdminController::class, 'cars'])->name('cars.index');
    Route::post('/cars', [AdminController::class, 'storeCar'])->name('cars.store');
    Route::put('/cars/{id}', [AdminController::class, 'updateCar'])->name('cars.update');
    Route::patch('/cars/{id}/toggle', [AdminController::class, 'toggleCar'])->name('cars.toggle');
    Route::delete('/cars/{id}', [AdminController::class, 'deleteCar'])->name('cars.delete');
    
    // Bookings Management
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings.index');
    Route::patch('/bookings/{id}/status', [AdminController::class, 'updateBookingStatus'])->name('bookings.status');
    
    // Users Management
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::patch('/users/{id}/role', [AdminController::class, 'updateUserRole'])->name('users.role');
    Route::patch('/users/{id}/password', [AdminController::class, 'resetUserPassword'])->name('users.password');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
});


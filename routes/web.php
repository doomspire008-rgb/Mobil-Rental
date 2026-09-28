<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\LandingPageController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Admin\CarController;
use App\Http\Controllers\Web\Admin\BookingController;
use App\Http\Controllers\Web\Admin\UserController;

Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/armada', [LandingPageController::class, 'cars'])->name('cars.index');
Route::get('/armada/{id}', [LandingPageController::class, 'carDetail'])->name('cars.show');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/booking', fn () => view('booking'))->name('booking');
    Route::get('/booking/{id}', fn () => view('booking.detail'))->name('booking.detail');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => view('auth.login'))->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', fn () => view('auth.register'))->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ===================== ADMIN PANEL =====================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/mobil', [CarController::class, 'index'])->name('cars.index');
    Route::get('/mobil/tambah', [CarController::class, 'create'])->name('cars.create');
    Route::post('/mobil', [CarController::class, 'store'])->name('cars.store');
    Route::get('/mobil/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/mobil/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/mobil/{car}', [CarController::class, 'destroy'])->name('cars.destroy');

    Route::get('/booking', [BookingController::class, 'index'])->name('bookings.index');
    Route::put('/booking/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');

    Route::get('/pengguna', [UserController::class, 'index'])->name('users.index');
    Route::put('/pengguna/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
});

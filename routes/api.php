<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    CarController,
    BookingController,
    PaymentController,
    UserController,
    DashboardController,
    LandingController,
    ReviewController,
    ReportController
};

// ===================== PUBLIC ROUTES =====================
Route::prefix('v1')->group(function () {
    
    // Auth
    Route::post('/register', [AuthController::class, 'register'])->name('api.register');
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('api.forgot-password');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('api.reset-password');
    
    // Landing Page Data
    Route::get('/landing', [LandingController::class, 'index']);
    Route::get('/featured-cars', [CarController::class, 'featured']);
    Route::get('/categories', [CarController::class, 'categories']);
    Route::get('/brands', [CarController::class, 'brands']);
    Route::get('/testimonials', [ReviewController::class, 'testimonials']);
    
    // Cars (Public)
    Route::get('/cars', [CarController::class, 'index']);
    Route::get('/cars/{id}', [CarController::class, 'show']);
    Route::get('/cars/search', [CarController::class, 'search']);
    Route::get('/cars/filter', [CarController::class, 'filter']);
    
    // ===================== PROTECTED ROUTES =====================
    Route::middleware(['auth:sanctum'])->group(function () {
        
        // Auth (Logged-in)
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [UserController::class, 'profile']);
        Route::put('/user', [UserController::class, 'updateProfile']);
        Route::put('/user/change-password', [UserController::class, 'changePassword']);
        
        // Bookings (Customer)
        Route::prefix('bookings')->group(function () {
            Route::get('/', [BookingController::class, 'index']);
            Route::get('/{id}', [BookingController::class, 'show']);
            Route::post('/', [BookingController::class, 'store']);
            Route::put('/{id}/cancel', [BookingController::class, 'cancel']);
            Route::get('/check-availability', [BookingController::class, 'checkAvailability']);
        });
        
        // Payments
        Route::prefix('payments')->group(function () {
            Route::post('/{bookingId}', [PaymentController::class, 'store']);
            Route::get('/{id}', [PaymentController::class, 'show']);
            Route::post('/{id}/upload-proof', [PaymentController::class, 'uploadProof']);
        });
        
        // Reviews
        Route::post('/cars/{carId}/reviews', [ReviewController::class, 'store']);
        Route::put('/reviews/{id}', [ReviewController::class, 'update']);
        Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);
        
        // ===================== ADMIN ROUTES =====================
        Route::middleware(['admin'])->prefix('admin')->group(function () {
            
            // Dashboard
            Route::get('/dashboard', [DashboardController::class, 'index']);
            Route::get('/stats', [DashboardController::class, 'stats']);
            
            // Cars CRUD
            Route::apiResource('cars', CarController::class)->except(['index', 'show']);
            Route::post('/cars/{id}/upload-gallery', [CarController::class, 'uploadGallery']);
            Route::delete('/cars/{id}/gallery/{image}', [CarController::class, 'deleteGalleryImage']);
            
            // Bookings Management
            Route::prefix('bookings')->group(function () {
                Route::get('/all', [BookingController::class, 'all']);
                Route::put('/{id}/status', [BookingController::class, 'updateStatus']);
                Route::put('/{id}/assign', [BookingController::class, 'assignCar']);
            });
            
            // Users Management
            Route::get('/users', [UserController::class, 'index']);
            Route::get('/users/{id}', [UserController::class, 'show']);
            Route::put('/users/{id}/role', [UserController::class, 'updateRole']);
            Route::delete('/users/{id}', [UserController::class, 'destroy']);
            
            // Payments Management
            Route::get('/payments', [PaymentController::class, 'index']);
            Route::put('/payments/{id}/verify', [PaymentController::class, 'verify']);
            Route::put('/payments/{id}/reject', [PaymentController::class, 'reject']);
            Route::put('/payments/{id}/status', [PaymentController::class, 'updateStatus']);
            
            // Reports
            Route::get('/reports/booking', [ReportController::class, 'bookingReport']);
            Route::get('/reports/revenue', [ReportController::class, 'revenueReport']);
            Route::get('/reports/car-popularity', [ReportController::class, 'carPopularity']);
        });
    });
});
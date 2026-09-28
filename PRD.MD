# PRD - Website Rental Mobil (Laravel 11+)
**Version:** 1.0.0  
**Target:** Desktop & Mobile (Responsive Mobile-First)

---

## 1. PRD LANDING PAGE

### 1.1 Tujuan
Landing page adalah wajah utama website yang bertujuan untuk:
- Menarik pengunjung untuk menyewa mobil
- Menyediakan akses cepat ke fitur pencarian
- Menampilkan promosi dan mobil unggulan
- Membangun kepercayaan melalui testimoni dan statistik

### 1.2 Struktur Halaman (Mobile-First)

#### A. Header & Navigasi

- **Desktop:** Navigasi horizontal penuh
- **Mobile:** Menu hamburger (sidebar)
- **Sticky header** saat scroll

#### B. Hero Section (Full Width)

- **Background:** Gambar atau video mobil
- **Form Pencarian:** (kunci utama!) dengan autocomplete lokasi
- **Tombol CTA:** "Cari Mobil Sekarang" (warna kontras)

#### C. Fitur Unggulan (3-4 Kolom)

- Ikon + judul + deskripsi singkat
- Responsif: 2 kolom di mobile, 4 kolom di desktop

#### D. Mobil Unggulan (Carousel/Grid)

- **Desktop:** Grid 3-4 kolom
- **Mobile:** Carousel swipe atau grid 2 kolom
- Setiap card: Gambar, nama, harga, rating, tombol sewa

#### E. Testimoni Pelanggan
- Slider testimoni dengan foto, nama, dan ulasan
- Rating bintang

#### F. Statistik (Counter)

- Animasi counter saat scroll

#### G. Cara Kerja (3 Langkah)


#### H. FAQ (Akordion)
- Pertanyaan umum seputar sewa mobil
- Desain accordion yang rapi

#### I. Footer
- Link penting (Tentang, Kontak, Syarat)
- Sosial media
- Copyright

### 1.3 UX Guidelines (Responsivitas)

| Komponen | Desktop (≥1024px) | Tablet (768-1023px) | Mobile (<768px) |
|----------|------------------|---------------------|-----------------|
| Navigasi | Horizontal full | Horizontal full | Hamburger menu |
| Hero Form | 1 baris (inline) | 2 baris | 3-4 baris (stack) |
| Car Grid | 3-4 kolom | 2-3 kolom | 1-2 kolom (carousel) |
| Font Size | 16-18px | 15-16px | 14-15px |
| Tombol | 16px padding | 14px | 12px (touch-friendly) |

### 1.4 Warna & Branding
- **Primary:** `#2563EB` (Biru) - Kepercayaan & Profesional
- **Secondary:** `#F59E0B` (Kuning/Emas) - CTA & Promo
- **Background:** `#F8FAFC` (Abu sangat terang)
- **Card:** White dengan shadow halus

---

## 2. BACKEND ARCHITECTURE (Laravel)

### 2.1 Struktur Folder (Laravel 11+)

app/
├── Http/
│ ├── Controllers/
│ │ ├── Api/
│ │ │ ├── AuthController.php
│ │ │ ├── CarController.php
│ │ │ ├── BookingController.php
│ │ │ ├── PaymentController.php
│ │ │ ├── UserController.php
│ │ │ ├── LandingController.php
│ │ │ └── ReviewController.php
│ │ └── Web/
│ │ └── LandingPageController.php
│ ├── Middleware/
│ └── Requests/
│ ├── CarRequest.php
│ ├── BookingRequest.php
│ └── AuthRequest.php
├── Models/
│ ├── User.php
│ ├── Car.php
│ ├── Booking.php
│ ├── Payment.php
│ ├── Category.php
│ └── Review.php
├── Services/
│ ├── CarService.php
│ ├── BookingService.php
│ └── PaymentService.php
└── Repositories/ (Opsional)
├── CarRepository.php
└── BookingRepository.php


### 2.2 Authentication (Sanctum)
```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

// api.php
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Protected routes
});

┌────────────┐      ┌─────────────┐      ┌────────────┐
│   users    │      │   cars      │      │ categories │
│────────────│      │─────────────│      │────────────│
│ id         │◄──── │ user_id     │      │ id         │
│ name       │      │ id          │      │ name       │
│ email      │      │ category_id │─────►│ slug       │
│ password   │      │ name        │      │ icon       │
│ phone      │      │ brand       │      └────────────┘
│ address    │      │ model       │
│ avatar     │      │ year        │      ┌────────────┐
│ role       │      │ plate_number│      │  reviews   │
│ created_at │      │ price_per_day│     │────────────│
└────────────┘      │ description │      │ id         │
     │              │ image       │      │ user_id    │──┐
     │              │ status      │      │ car_id     │──┼─► cars
     │              │ seats       │      │ rating     │  │
     │              │ transmission│      │ comment    │  │
     │              │ fuel_type   │      │ created_at │  │
     │              │ is_available│      └────────────┘  │
     │              │ created_at  │                      │
     │              └─────────────┘                      │
     │                   ▲                              │
     │                   │                              │
     ▼                   │                              │
┌────────────┐           │      ┌────────────┐         │
│  bookings  │           │      │ payments   │         │
│────────────│           │      │────────────│         │
│ id         │           │      │ id         │         │
│ user_id    │───────────┘      │ booking_id │─────────┘
│ car_id     │──────────────────│ amount     │
│ start_date │                  │ status     │
│ end_date   │                  │ payment_date│
│ total_price│                  │ method     │
│ status     │                  │ proof      │
│ notes      │                  └────────────┘
│ created_at │
└────────────┘

Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->string('phone', 15)->nullable();
    $table->text('address')->nullable();
    $table->string('avatar')->nullable();
    $table->enum('role', ['admin', 'customer'])->default('customer');
    $table->string('ktp_number')->nullable()->unique();
    $table->string('driver_license')->nullable()->unique();
    $table->rememberToken();
    $table->timestamps();
});

Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name')->unique();
    $table->string('slug')->unique();
    $table->string('icon')->nullable();
    $table->timestamps();
});

Schema::create('cars', function (Blueprint $table) {
    $table->id();
    $table->foreignId('category_id')->constrained();
    $table->string('name');
    $table->string('brand');
    $table->string('model');
    $table->year('year');
    $table->string('plate_number')->unique();
    $table->decimal('price_per_day', 10, 2);
    $table->text('description');
    $table->string('image')->nullable();
    $table->json('gallery_images')->nullable();
    $table->enum('status', ['available', 'rented', 'maintenance'])->default('available');
    $table->integer('seats')->default(4);
    $table->enum('transmission', ['manual', 'automatic'])->default('manual');
    $table->enum('fuel_type', ['bensin', 'diesel', 'electric'])->default('bensin');
    $table->boolean('is_available')->default(true);
    $table->integer('stock')->default(1);
    $table->timestamps();
});

Schema::create('bookings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('car_id')->constrained()->onDelete('cascade');
    $table->date('start_date');
    $table->date('end_date');
    $table->time('pickup_time')->nullable();
    $table->time('return_time')->nullable();
    $table->decimal('total_price', 12, 2);
    $table->decimal('deposit', 12, 2)->nullable();
    $table->enum('status', [
        'pending', 'confirmed', 'processing', 
        'active', 'completed', 'cancelled', 'rejected'
    ])->default('pending');
    $table->text('notes')->nullable();
    $table->string('pickup_location')->nullable();
    $table->string('return_location')->nullable();
    $table->timestamps();
});

Schema::create('payments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('booking_id')->constrained()->onDelete('cascade');
    $table->decimal('amount', 12, 2);
    $table->enum('status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
    $table->string('method')->nullable(); // 'credit_card', 'bank_transfer', 'cash'
    $table->string('transaction_id')->nullable();
    $table->datetime('payment_date')->nullable();
    $table->string('proof_image')->nullable(); // bukti transfer
    $table->timestamps();
});

Schema::create('reviews', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained();
    $table->foreignId('car_id')->constrained();
    $table->foreignId('booking_id')->constrained();
    $table->integer('rating')->min(1)->max(5);
    $table->text('comment')->nullable();
    $table->timestamps();
});

4.1 Struktur Routes API (routes/api.php)
php
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
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
    
    // Landing Page Data
    Route::get('/landing', [LandingController::class, 'index']);
    Route::get('/featured-cars', [CarController::class, 'featured']);
    Route::get('/categories', [CarController::class, 'categories']);
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
        Route::put('/user', [UserController::class, 'update']);
        Route::put('/user/change-password', [UserController::class, 'changePassword']);
        
        // Bookings (Customer)
        Route::prefix('bookings')->group(function () {
            Route::get('/', [BookingController::class, 'index']); // My bookings
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
            Route::put('/payments/{id}/status', [PaymentController::class, 'updateStatus']);
            
            // Reports
            Route::get('/reports/booking', [ReportController::class, 'bookingReport']);
            Route::get('/reports/revenue', [ReportController::class, 'revenueReport']);
            Route::get('/reports/car-popularity', [ReportController::class, 'carPopularity']);
        });
    });
});

4.2 Contoh Response API (Landing Page)
json
{
  "success": true,
  "data": {
    "hero": {
      "title": "Sewa Mobil Mudah & Cepat",
      "subtitle": "Dapatkan mobil impian Anda dengan harga terbaik",
      "cta_text": "Cari Mobil Sekarang"
    },
    "features": [
      {"icon": "shield-check", "title": "Aman & Terpercaya", "desc": "..."},
      {"icon": "clock", "title": "24/7 Support", "desc": "..."}
    ],
    "featured_cars": [
      {
        "id": 1,
        "name": "Toyota Avanza",
        "price_per_day": 500000,
        "image": "/storage/cars/avanza.jpg",
        "rating": 4.5
      }
    ],
    "stats": {
      "cars_count": 500,
      "customers_count": 1000
    }
  }
}
5. CRUD OPERATIONS (Controllers & Services)
5.1 CarController.php (Core CRUD)
php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Http\Requests\CarRequest;
use App\Services\CarService;
use Illuminate\Http\Request;

class CarController extends Controller
{
    protected $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    // PUBLIC
    public function index(Request $request)
    {
        $cars = $this->carService->getAllCars($request);
        return response()->json(['success' => true, 'data' => $cars]);
    }

    public function show($id)
    {
        $car = Car::with(['category', 'reviews.user'])->findOrFail($id);
        return response()->json(['success' => true, 'data' => $car]);
    }

    public function featured()
    {
        $cars = Car::where('is_available', true)
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->limit(6)
            ->get();
        return response()->json(['success' => true, 'data' => $cars]);
    }

    // ADMIN CRUD
    public function store(CarRequest $request)
    {
        $car = $this->carService->createCar($request->validated());
        return response()->json(['success' => true, 'message' => 'Mobil ditambahkan', 'data' => $car], 201);
    }

    public function update(CarRequest $request, $id)
    {
        $car = Car::findOrFail($id);
        $updated = $this->carService->updateCar($car, $request->validated());
        return response()->json(['success' => true, 'message' => 'Mobil diperbarui', 'data' => $updated]);
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        if ($car->bookings()->whereIn('status', ['pending', 'confirmed', 'active'])->exists()) {
            return response()->json(['success' => false, 'message' => 'Mobil sedang dipesan'], 422);
        }
        $car->delete();
        return response()->json(['success' => true, 'message' => 'Mobil dihapus']);
    }
}
5.2 BookingController.php
php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Http\Requests\BookingRequest;
use App\Services\BookingService;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->with(['car', 'payment'])
            ->latest()
            ->paginate(10);
        return response()->json(['success' => true, 'data' => $bookings]);
    }

    public function store(BookingRequest $request)
    {
        $available = $this->bookingService->checkAvailability(
            $request->car_id,
            $request->start_date,
            $request->end_date
        );

        if (!$available) {
            return response()->json(['success' => false, 'message' => 'Mobil tidak tersedia'], 422);
        }

        $booking = $this->bookingService->createBooking(auth()->id(), $request->validated());
        return response()->json(['success' => true, 'message' => 'Booking berhasil', 'data' => $booking], 201);
    }

    public function cancel($id)
    {
        $booking = Booking::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'confirmed'])
            ->findOrFail($id);
        $this->bookingService->cancelBooking($booking);
        return response()->json(['success' => true, 'message' => 'Booking dibatalkan']);
    }
}
5.3 BookingService.php (Business Logic)
php
<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingService
{
    public function checkAvailability($carId, $startDate, $endDate)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        $overlapping = Booking::where('car_id', $carId)
            ->whereNotIn('status', ['cancelled', 'completed'])
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_date', [$start, $end])
                      ->orWhereBetween('end_date', [$start, $end])
                      ->orWhere(function ($q) use ($start, $end) {
                          $q->where('start_date', '<=', $start)
                            ->where('end_date', '>=', $end);
                      });
            })
            ->exists();

        if ($overlapping) return false;

        $car = Car::find($carId);
        $activeBookings = Booking::where('car_id', $carId)
            ->where('status', 'active')
            ->count();

        return $activeBookings < $car->stock;
    }

    public function createBooking($userId, array $data)
    {
        $car = Car::findOrFail($data['car_id']);
        $days = Carbon::parse($data['start_date'])->diffInDays(Carbon::parse($data['end_date'])) + 1;
        $totalPrice = $car->price_per_day * $days;

        return DB::transaction(function () use ($userId, $car, $data, $totalPrice) {
            $booking = Booking::create([
                'user_id' => $userId,
                'car_id' => $car->id,
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'total_price' => $totalPrice,
                'deposit' => $totalPrice * 0.1,
                'status' => 'pending',
                'notes' => $data['notes'] ?? null,
            ]);

            if ($car->stock <= 1) {
                $car->update(['status' => 'rented']);
            }

            return $booking;
        });
    }

    public function cancelBooking(Booking $booking)
    {
        $booking->update(['status' => 'cancelled']);
        $car = Car::find($booking->car_id);
        if ($car->status === 'rented') {
            $car->update(['status' => 'available']);
        }
        return $booking;
    }
}
5.4 Request Validation (CarRequest.php)
php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user() && auth()->user()->role === 'admin';
    }

    public function rules()
    {
        $id = $this->route('id');
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
            'plate_number' => 'required|string|max:15|unique:cars,plate_number,' . $id,
            'price_per_day' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'seats' => 'required|integer|min:1|max:15',
            'transmission' => 'required|in:manual,automatic',
            'fuel_type' => 'required|in:bensin,diesel,electric',
            'stock' => 'required|integer|min:1',
        ];
    }
}
6. DEPLOYMENT CHECKLIST
□ Set APP_ENV=production & APP_DEBUG=false di .env
□ Migrasi database: php artisan migrate --force
□ Seed data: php artisan db:seed --force
□ Setup queue worker untuk email notification
□ Optimasi cache: php artisan optimize
□ Setup backup database otomatis (Laravel Backup)
□ Konfigurasi CORS untuk frontend
7. QUICK REFERENCE COMMANDS
bash
# Buat semua controller
php artisan make:controller Api/AuthController
php artisan make:controller Api/CarController
php artisan make:controller Api/BookingController
php artisan make:controller Api/PaymentController
php artisan make:controller Api/UserController
php artisan make:controller Api/DashboardController
php artisan make:controller Api/LandingController
php artisan make:controller Api/ReviewController

# Buat Request
php artisan make:request CarRequest
php artisan make:request BookingRequest

# Buat Service (manual buat folder Services)
php artisan make:service CarService # (butuh package atau buat manual)
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Category;
use App\Models\Review;
use App\Services\CarService;

class LandingController extends Controller
{
    protected CarService $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function index()
    {
        $featuredCars = $this->carService->getFeaturedCars(6);
        $categories = $this->carService->getCategories();
        $testimonials = Review::with('user', 'car')
            ->whereHas('booking', fn ($q) => $q->where('status', 'completed'))
            ->latest()
            ->limit(6)
            ->get();

        $stats = [
            'cars_count' => Car::where('is_available', true)->count(),
            'customers_count' => \App\Models\User::where('role', 'customer')->count(),
            'bookings_count' => \App\Models\Booking::where('status', 'completed')->count(),
            'cities_count' => 25,
        ];

        $features = [
            [
                'icon' => 'shield-check',
                'title' => 'Aman & Terpercaya',
                'description' => 'Semua mobil terasuransi dan melalui pemeriksaan berkala',
            ],
            [
                'icon' => 'clock',
                'title' => '24/7 Support',
                'description' => 'Tim support siap membantu Anda kapan saja',
            ],
            [
                'icon' => 'map-pin',
                'title' => 'Jangkauan Luas',
                'description' => 'Tersedia di 25+ kota di seluruh Indonesia',
            ],
            [
                'icon' => 'credit-card',
                'title' => 'Pembayaran Fleksibel',
                'description' => 'Transfer bank, kartu kredit, atau e-wallet',
            ],
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'hero' => [
                    'title' => 'Sewa Mobil Mudah & Cepat',
                    'subtitle' => 'Dapatkan mobil impian Anda dengan harga terbaik dan layanan terpercaya',
                    'cta_text' => 'Cari Mobil Sekarang',
                ],
                'features' => $features,
                'featured_cars' => $featuredCars,
                'categories' => $categories,
                'testimonials' => $testimonials,
                'stats' => $stats,
            ],
        ]);
    }
}
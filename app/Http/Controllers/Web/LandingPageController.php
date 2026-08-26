<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Category;
use App\Models\Review;
use App\Services\CarService;

class LandingPageController extends Controller
{
    protected CarService $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function index()
    {
        $featuredCars = $this->carService->getFeaturedCars(8);
        $categories = $this->carService->getCategories();
        $testimonials = Review::with('user', 'car')
            ->whereHas('booking', fn ($q) => $q->where('status', 'completed'))
            ->where('rating', '>=', 4)
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

        $faqs = [
            [
                'question' => 'Berapa hari minimal sewa mobil?',
                'answer' => 'Minimal sewa mobil adalah 1 hari (24 jam). Untuk sewa bulanan tersedia diskon khusus.',
            ],
            [
                'question' => 'Apakah mobil dilengkapi supir?',
                'answer' => 'Ya, kami menyediakan opsi sewa dengan supir atau lepas kunci (self-drive) sesuai kebutuhan Anda.',
            ],
            [
                'question' => 'Dokumen apa yang diperlukan untuk sewa?',
                'answer' => 'KTP/SIM untuk identitas, KTP untuk jaminan, dan kartu kredit/debit atau transfer bank untuk pembayaran.',
            ],
            [
                'question' => 'Bagaimana jika mobil mengalami kerusakan saat sewa?',
                'answer' => 'Semua mobil kami terasuransi all-risk. Hubungi customer service 24/7 kami untuk bantuan darurat.',
            ],
            [
                'question' => 'Apakah bisa antar-jemput mobil?',
                'answer' => 'Ya, kami menyediakan layanan antar-jemput ke bandara, hotel, atau alamat Anda dengan biaya tambahan.',
            ],
            [
                'question' => 'Bagaimana cara pembatalan booking?',
                'answer' => 'Bisa dibatalkan melalui aplikasi atau hubungi CS. Bebas biaya jika dibatalkan minimal 24 jam sebelum waktu sewa.',
            ],
        ];

        return view('landing', compact(
            'featuredCars',
            'categories',
            'testimonials',
            'stats',
            'features',
            'faqs'
        ));
    }

    public function cars()
    {
        $cars = $this->carService->getAllCars(request());
        $categories = $this->carService->getCategories();
        $brands = $this->carService->getBrands();

        return view('cars.index', compact('cars', 'categories', 'brands'));
    }

    public function carDetail(int $id)
    {
        $car = $this->carService->getCarById($id);
        $relatedCars = Car::available()
            ->where('category_id', $car->category_id)
            ->where('id', '!=', $car->id)
            ->with(['category', 'reviews'])
            ->limit(4)
            ->get();

        return view('cars.detail', compact('car', 'relatedCars'));
    }
}
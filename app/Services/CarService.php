<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CarService
{
    public function getAllCars(Request $request): LengthAwarePaginator
    {
        $query = Car::query()->with(['category', 'reviews'])
            ->when($request->filled('category'), fn ($q) => $q->whereHas('category', fn ($cq) => $cq->where('slug', $request->category)))
            ->when($request->filled('brand'), fn ($q) => $q->where('brand', $request->brand))
            ->when($request->filled('transmission'), fn ($q) => $q->where('transmission', $request->transmission))
            ->when($request->filled('fuel_type'), fn ($q) => $q->where('fuel_type', $request->fuel_type))
            ->when($request->filled('min_price'), fn ($q) => $q->where('price_per_day', '>=', $request->min_price))
            ->when($request->filled('max_price'), fn ($q) => $q->where('price_per_day', '<=', $request->max_price))
            ->when($request->filled('seats'), fn ($q) => $q->where('seats', '>=', $request->seats))
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($subQ) use ($request) {
                    $subQ->where('name', 'like', "%{$request->search}%")
                        ->orWhere('brand', 'like', "%{$request->search}%")
                        ->orWhere('model', 'like', "%{$request->search}%");
                });
            })
            ->when($request->filled('sort'), function ($q) use ($request) {
                match ($request->sort) {
                    'price_asc' => $q->orderBy('price_per_day', 'asc'),
                    'price_desc' => $q->orderBy('price_per_day', 'desc'),
                    'newest' => $q->latest(),
                    'popular' => $q->withCount('bookings')->orderBy('bookings_count', 'desc'),
                    default => $q->latest(),
                };
            }, fn ($q) => $q->latest());

        return $query->paginate($request->get('per_page', 12))->withQueryString();
    }

    public function getFeaturedCars(int $limit = 6)
    {
        return Car::available()
            ->with(['category', 'reviews'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function getCarById(int $id)
    {
        return Car::with(['category', 'reviews.user'])->findOrFail($id);
    }

    public function createCar(array $data): Car
    {
        return DB::transaction(function () use ($data) {
            $car = Car::create($data);
            return $car->load('category');
        });
    }

    public function updateCar(Car $car, array $data): Car
    {
        return DB::transaction(function () use ($car, $data) {
            $car->update($data);
            return $car->load('category');
        });
    }

    public function deleteCar(Car $car): bool
    {
        if ($car->bookings()->whereIn('status', ['pending', 'confirmed', 'active'])->exists()) {
            throw new \Exception('Mobil sedang dipesan, tidak dapat dihapus');
        }
        return $car->delete();
    }

    public function getCategories()
    {
        return Category::withCount('cars')->get();
    }

    public function getBrands()
    {
        return Car::distinct()->pluck('brand')->sort()->values();
    }

    public function searchCars(Request $request)
    {
        return $this->getAllCars($request);
    }

    public function filterCars(Request $request)
    {
        return $this->getAllCars($request);
    }
}
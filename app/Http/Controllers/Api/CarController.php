<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\Category;
use App\Services\CarService;
use Illuminate\Http\Request;

class CarController extends Controller
{
    protected CarService $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function index(Request $request)
    {
        $cars = $this->carService->getAllCars($request);
        
        return response()->json([
            'success' => true,
            'data' => $cars,
        ]);
    }

    public function show(int $id)
    {
        $car = $this->carService->getCarById($id);
        
        return response()->json([
            'success' => true,
            'data' => $car,
        ]);
    }

    public function featured()
    {
        $cars = $this->carService->getFeaturedCars();
        
        return response()->json([
            'success' => true,
            'data' => $cars,
        ]);
    }

    public function categories()
    {
        $categories = $this->carService->getCategories();
        
        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }

    public function brands()
    {
        $brands = $this->carService->getBrands();
        
        return response()->json([
            'success' => true,
            'data' => $brands,
        ]);
    }

    public function search(Request $request)
    {
        $cars = $this->carService->searchCars($request);
        
        return response()->json([
            'success' => true,
            'data' => $cars,
        ]);
    }

    public function filter(Request $request)
    {
        $cars = $this->carService->filterCars($request);
        
        return response()->json([
            'success' => true,
            'data' => $cars,
        ]);
    }

    public function store(CarRequest $request)
    {
        $car = $this->carService->createCar($request->validated());
        
        return response()->json([
            'success' => true,
            'message' => 'Mobil berhasil ditambahkan',
            'data' => $car,
        ], 201);
    }

    public function update(CarRequest $request, int $id)
    {
        $car = Car::findOrFail($id);
        $updated = $this->carService->updateCar($car, $request->validated());
        
        return response()->json([
            'success' => true,
            'message' => 'Mobil berhasil diperbarui',
            'data' => $updated,
        ]);
    }

    public function destroy(int $id)
    {
        $car = Car::findOrFail($id);
        $this->carService->deleteCar($car);
        
        return response()->json([
            'success' => true,
            'message' => 'Mobil berhasil dihapus',
        ]);
    }

    public function uploadGallery(Request $request, int $id)
    {
        $car = Car::findOrFail($id);
        
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'string|max:500',
        ]);

        $galleryImages = $car->gallery_images ?? [];
        $galleryImages = array_merge($galleryImages, $request->images);
        
        $car->update(['gallery_images' => $galleryImages]);
        
        return response()->json([
            'success' => true,
            'message' => 'Galeri berhasil ditambahkan',
            'data' => $car,
        ]);
    }

    public function deleteGalleryImage(Request $request, int $id, string $image)
    {
        $car = Car::findOrFail($id);
        
        $galleryImages = $car->gallery_images ?? [];
        $galleryImages = array_filter($galleryImages, fn ($img) => $img !== $image);
        $galleryImages = array_values($galleryImages);
        
        $car->update(['gallery_images' => $galleryImages]);
        
        return response()->json([
            'success' => true,
            'message' => 'Gambar galeri berhasil dihapus',
            'data' => $car,
        ]);
    }
}
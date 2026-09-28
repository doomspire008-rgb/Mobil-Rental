<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Category;
use App\Services\CarService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarController extends Controller
{
    protected CarService $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function index(Request $request): View
    {
        $cars = Car::query()
            ->with('category')
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($sub) use ($request) {
                    $sub->where('name', 'like', "%{$request->search}%")
                        ->orWhere('brand', 'like', "%{$request->search}%")
                        ->orWhere('plate_number', 'like', "%{$request->search}%");
                });
            })
            ->when($request->filled('category'), fn ($q) => $q->where('category_id', $request->category))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::all();

        return view('admin.cars.index', compact('cars', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('admin.cars.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $this->carService->createCar($data);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Mobil "' . $data['name'] . '" berhasil ditambahkan.');
    }

    public function edit(Car $car): View
    {
        $categories = Category::all();
        return view('admin.cars.edit', compact('car', 'categories'));
    }

    public function update(Request $request, Car $car): RedirectResponse
    {
        $data = $this->validateData($request, $car->id);
        $this->carService->updateCar($car, $data);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Mobil "' . $data['name'] . '" berhasil diperbarui.');
    }

    public function destroy(Car $car): RedirectResponse
    {
        try {
            $this->carService->deleteCar($car);
        } catch (\Exception $e) {
            return redirect()->route('admin.cars.index')->with('error', $e->getMessage());
        }

        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil dihapus.');
    }

    protected function validateData(Request $request, ?int $carId = null): array
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'plate_number' => 'required|string|max:15|unique:cars,plate_number,' . $carId,
            'price_per_day' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
            'seats' => 'required|integer|min:1|max:15',
            'transmission' => 'required|in:manual,automatic',
            'fuel_type' => 'required|in:bensin,diesel,electric',
            'status' => 'required|in:available,rented,maintenance',
            'stock' => 'required|integer|min:1',
        ]);

        $data['is_available'] = $request->boolean('is_available');

        return $data;
    }
}

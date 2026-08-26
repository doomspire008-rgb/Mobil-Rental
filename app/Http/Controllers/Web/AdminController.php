<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_cars' => Car::count(),
            'available_cars' => Car::where('is_available', true)->count(),
            'rented_cars' => Car::where('is_available', false)->count(),
            'total_bookings' => Booking::count(),
            'active_bookings' => Booking::where('status', 'active')->count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'completed_bookings' => Booking::where('status', 'completed')->count(),
            'total_revenue' => Booking::whereIn('status', ['active', 'completed'])->sum('total_price'),
            'total_customers' => User::where('role', 'customer')->count(),
        ];

        $recentBookings = Booking::with(['user', 'car.category'])
            ->latest()
            ->limit(8)
            ->get();

        $featuredCars = Car::with('category')
            ->withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'featuredCars'));
    }

    public function cars(Request $request)
    {
        $query = Car::with(['category', 'reviews'])->withCount('bookings');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('plate_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            if ($request->status === 'available') {
                $query->where('is_available', true);
            } elseif ($request->status === 'rented') {
                $query->where('is_available', false);
            }
        }

        $cars = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.cars.index', compact('cars', 'categories'));
    }

    public function storeCar(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:2015|max:' . (date('Y') + 1),
            'plate_number' => 'required|string|max:20|unique:cars,plate_number',
            'price_per_day' => 'required|numeric|min:100000',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
            'seats' => 'required|integer|min:2|max:20',
            'transmission' => 'required|in:automatic,manual',
            'fuel_type' => 'required|in:bensin,diesel,electric,hybrid',
            'stock' => 'required|integer|min:1',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('cars', 'public');
            $validated['image'] = '/storage/' . $path;
        } elseif (empty($validated['image'])) {
            return back()->withInput()->with('error', 'Silakan pilih foto mobil untuk diunggah atau masukkan URL gambar.');
        }

        unset($validated['image_file']);
        $validated['is_available'] = true;
        $validated['status'] = 'available';

        Car::create($validated);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Mobil baru "' . $validated['name'] . '" berhasil ditambahkan ke armada!');
    }

    public function updateCar(Request $request, int $id)
    {
        $car = Car::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:2015|max:' . (date('Y') + 1),
            'plate_number' => 'required|string|max:20|unique:cars,plate_number,' . $car->id,
            'price_per_day' => 'required|numeric|min:100000',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
            'seats' => 'required|integer|min:2|max:20',
            'transmission' => 'required|in:automatic,manual',
            'fuel_type' => 'required|in:bensin,diesel,electric,hybrid',
            'stock' => 'required|integer|min:1',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('cars', 'public');
            $validated['image'] = '/storage/' . $path;
        } elseif (empty($validated['image'])) {
            $validated['image'] = $car->image;
        }

        unset($validated['image_file']);
        $car->update($validated);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Informasi mobil "' . $car->name . '" berhasil diperbarui!');
    }

    public function toggleCar(int $id)
    {
        $car = Car::findOrFail($id);
        $car->is_available = !$car->is_available;
        $car->status = $car->is_available ? 'available' : 'rented';
        $car->save();

        $statusText = $car->is_available ? 'Tersedia' : 'Disewa / Tidak Tersedia';
        return back()->with('success', 'Status mobil "' . $car->name . '" diubah menjadi ' . $statusText);
    }

    public function deleteCar(int $id)
    {
        $car = Car::findOrFail($id);

        if ($car->bookings()->whereIn('status', ['active', 'pending'])->exists()) {
            return back()->with('error', 'Mobil tidak dapat dihapus karena masih memiliki transaksi booking aktif/menunggu.');
        }

        $carName = $car->name;
        $car->delete();

        return redirect()->route('admin.cars.index')
            ->with('success', 'Mobil "' . $carName . '" berhasil dihapus dari sistem.');
    }

    public function bookings(Request $request)
    {
        $query = Booking::with(['user', 'car.category']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', fn ($uq) => $uq->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"))
                  ->orWhereHas('car', fn ($cq) => $cq->where('name', 'like', "%{$search}%")->orWhere('plate_number', 'like', "%{$search}%"));
            });
        }

        $bookings = $query->latest()->paginate(12)->withQueryString();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function updateBookingStatus(Request $request, int $id)
    {
        $booking = Booking::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,active,completed,cancelled',
        ]);

        $booking->status = $validated['status'];
        $booking->save();

        // If completed or cancelled, make car available if no other active booking
        if (in_array($booking->status, ['completed', 'cancelled'])) {
            $activeCount = Booking::where('car_id', $booking->car_id)
                ->whereIn('status', ['active', 'confirmed'])
                ->where('id', '!=', $booking->id)
                ->count();
            if ($activeCount === 0) {
                $booking->car->update(['is_available' => true, 'status' => 'available']);
            }
        } elseif ($booking->status === 'active') {
            $booking->car->update(['is_available' => false, 'status' => 'rented']);
        }

        return back()->with('success', 'Status booking #' . $booking->id . ' berhasil diperbarui menjadi ' . ucfirst($booking->status));
    }

    public function users()
    {
        $users = User::withCount('bookings')->latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }
}

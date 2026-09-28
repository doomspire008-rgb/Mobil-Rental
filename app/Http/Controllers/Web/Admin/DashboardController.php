<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'cars_count' => Car::count(),
            'cars_available' => Car::where('is_available', true)->count(),
            'bookings_pending' => Booking::where('status', 'pending')->count(),
            'bookings_active' => Booking::where('status', 'active')->count(),
            'customers_count' => User::where('role', 'customer')->count(),
            'revenue' => Booking::where('status', 'completed')->sum('total_price'),
        ];

        $recentBookings = Booking::with(['car', 'user'])->latest()->limit(6)->get();

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }
}

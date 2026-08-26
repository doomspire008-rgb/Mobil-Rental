<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_cars' => Car::count(),
            'available_cars' => Car::where('is_available', true)->where('status', 'available')->count(),
            'rented_cars' => Car::where('status', 'rented')->count(),
            'maintenance_cars' => Car::where('status', 'maintenance')->count(),
            'total_users' => User::where('role', 'customer')->count(),
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'active_bookings' => Booking::where('status', 'active')->count(),
            'completed_bookings' => Booking::where('status', 'completed')->count(),
            'total_revenue' => Payment::where('status', 'paid')->sum('amount'),
            'pending_payments' => Payment::where('status', 'pending')->sum('amount'),
        ];

        $monthlyRevenue = Payment::where('status', 'paid')
            ->whereYear('payment_date', now()->year)
            ->selectRaw('MONTH(payment_date) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->map(fn ($v) => (float) $v);

        $bookingStatus = Booking::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $topCars = Car::withCount('bookings')
            ->withAvg('reviews', 'rating')
            ->orderBy('bookings_count', 'desc')
            ->limit(5)
            ->get(['id', 'name', 'brand', 'model', 'price_per_day', 'image']);

        return response()->json([
            'success' => true,
            'data' => [
                'stats' => $stats,
                'monthly_revenue' => $monthlyRevenue,
                'booking_status' => $bookingStatus,
                'top_cars' => $topCars,
            ],
        ]);
    }

    public function stats()
    {
        $now = now();
        $lastMonth = $now->copy()->subMonth();

        $currentMonthBookings = Booking::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();
        
        $lastMonthBookings = Booking::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();

        $currentMonthRevenue = Payment::where('status', 'paid')
            ->whereMonth('payment_date', $now->month)
            ->whereYear('payment_date', $now->year)
            ->sum('amount');
        
        $lastMonthRevenue = Payment::where('status', 'paid')
            ->whereMonth('payment_date', $lastMonth->month)
            ->whereYear('payment_date', $lastMonth->year)
            ->sum('amount');

        return response()->json([
            'success' => true,
            'data' => [
                'bookings_growth' => $lastMonthBookings > 0 
                    ? round((($currentMonthBookings - $lastMonthBookings) / $lastMonthBookings) * 100, 1)
                    : ($currentMonthBookings > 0 ? 100 : 0),
                'revenue_growth' => $lastMonthRevenue > 0
                    ? round((($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1)
                    : ($currentMonthRevenue > 0 ? 100 : 0),
                'current_month_bookings' => $currentMonthBookings,
                'last_month_bookings' => $lastMonthBookings,
                'current_month_revenue' => $currentMonthRevenue,
                'last_month_revenue' => $lastMonthRevenue,
            ],
        ]);
    }
}
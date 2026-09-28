<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function bookingReport(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'nullable|in:pending,confirmed,processing,active,completed,cancelled,rejected',
        ]);

        $startDate = $request->start_date ? Carbon::parse($request->start_date) : Carbon::now()->startOfMonth();
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : Carbon::now()->endOfMonth();

        $bookings = Booking::with(['car.category', 'user', 'payment'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate($request->get('per_page', 50))
            ->withQueryString();

        return response()->json([
            'success' => true,
            'data' => $bookings,
        ]);
    }

    public function revenueReport(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'group_by' => 'nullable|in:day,week,month',
        ]);

        $startDate = $request->start_date ? Carbon::parse($request->start_date) : Carbon::now()->startOfMonth();
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : Carbon::now()->endOfMonth();
        $groupBy = $request->get('group_by', 'day');

        $format = match ($groupBy) {
            'day' => 'DATE(payment_date)',
            'week' => 'YEARWEEK(payment_date)',
            'month' => 'DATE_FORMAT(payment_date, "%Y-%m")',
            default => 'DATE(payment_date)',
        };

        $revenue = Payment::where('status', 'paid')
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->selectRaw("{$format} as period, SUM(amount) as total, COUNT(*) as transactions")
            ->groupBy('period')
            ->orderBy('period')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $revenue,
        ]);
    }

    public function carPopularity(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'limit' => 'nullable|integer|min:1|max:50',
        ]);

        $startDate = $request->start_date ? Carbon::parse($request->start_date) : Carbon::now()->subMonths(3);
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : Carbon::now();
        $limit = $request->get('limit', 10);

        $popularCars = Car::with(['category'])
            ->withCount(['bookings' => function ($q) use ($startDate, $endDate) {
                $q->whereBetween('created_at', [$startDate, $endDate])
                    ->whereNotIn('status', ['cancelled', 'rejected']);
            }])
            ->withAvg('reviews', 'rating')
            ->having('bookings_count', '>', 0)
            ->orderBy('bookings_count', 'desc')
            ->limit($limit)
            ->get(['id', 'name', 'brand', 'model', 'price_per_day', 'image', 'category_id']);

        return response()->json([
            'success' => true,
            'data' => $popularCars,
        ]);
    }
}
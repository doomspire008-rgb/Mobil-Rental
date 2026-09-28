<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index(Request $request)
    {
        $bookings = Booking::where('user_id', $request->user()->id)
            ->with(['car.category', 'payment'])
            ->latest()
            ->paginate($request->get('per_page', 10))
            ->withQueryString();

        return response()->json([
            'success' => true,
            'data' => $bookings,
        ]);
    }

    public function show(int $id)
    {
        $booking = Booking::where('user_id', request()->user()->id)
            ->with(['car.category', 'payment', 'review'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $booking,
        ]);
    }

    public function store(BookingRequest $request)
    {
        $booking = $this->bookingService->createBooking($request->user()->id, $request->validated());
        
        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil dibuat',
            'data' => $booking,
        ], 201);
    }

    public function cancel(int $id)
    {
        $booking = Booking::where('user_id', request()->user()->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->findOrFail($id);
        
        $this->bookingService->cancelBooking($booking);
        
        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil dibatalkan',
            'data' => $booking->load(['car.category']),
        ]);
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $available = $this->bookingService->checkAvailability(
            $request->car_id,
            $request->start_date,
            $request->end_date
        );

        return response()->json([
            'success' => true,
            'data' => [
                'available' => $available,
            ],
        ]);
    }

    public function all(Request $request)
    {
        $bookings = Booking::with(['car.category', 'user', 'payment'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->whereHas('user', fn ($uq) => $uq->where('name', 'like', "%{$request->search}%"))
                    ->orWhereHas('car', fn ($cq) => $cq->where('name', 'like', "%{$request->search}%"));
            })
            ->latest()
            ->paginate($request->get('per_page', 20))
            ->withQueryString();

        return response()->json([
            'success' => true,
            'data' => $bookings,
        ]);
    }

    public function updateStatus(Request $request, int $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,active,completed,cancelled,rejected',
        ]);

        $booking = Booking::findOrFail($id);
        $updated = $this->bookingService->updateBookingStatus($booking, $request->status);
        
        return response()->json([
            'success' => true,
            'message' => 'Status booking diperbarui',
            'data' => $updated,
        ]);
    }

    public function assignCar(Request $request, int $id)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
        ]);

        $booking = Booking::findOrFail($id);
        $newCar = \App\Models\Car::findOrFail($request->car_id);
        
        if (!$this->bookingService->checkAvailability($newCar->id, $booking->start_date, $booking->end_date)) {
            return response()->json([
                'success' => false,
                'message' => 'Mobil pengganti tidak tersedia pada tanggal tersebut',
            ], 422);
        }

        $booking->update(['car_id' => $newCar->id]);
        
        return response()->json([
            'success' => true,
            'message' => 'Mobil berhasil diganti',
            'data' => $booking->load(['car.category']),
        ]);
    }
}
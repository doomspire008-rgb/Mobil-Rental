<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    protected BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index(Request $request): View
    {
        $bookings = Booking::query()
            ->with(['car', 'user'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking): RedirectResponse
    {
        $data = $request->validate([
            'status' => 'required|in:pending,confirmed,processing,active,completed,cancelled,rejected',
        ]);

        $this->bookingService->updateBookingStatus($booking, $data['status']);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Status booking #' . $booking->id . ' berhasil diperbarui.');
    }
}

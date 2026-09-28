<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function store(Request $request, int $bookingId)
    {
        $booking = Booking::where('user_id', $request->user()->id)
            ->findOrFail($bookingId);

        if ($booking->payment) {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran sudah dibuat untuk booking ini',
            ], 422);
        }

        $request->validate([
            'method' => 'nullable|in:credit_card,bank_transfer,cash',
            'amount' => 'nullable|numeric|min:0',
        ]);

        $payment = $this->paymentService->createPayment($bookingId, $request->validated());
        
        return response()->json([
            'success' => true,
            'message' => 'Pembayaran dibuat, silakan lakukan pembayaran',
            'data' => $payment,
        ], 201);
    }

    public function show(int $id)
    {
        $payment = Payment::with('booking.car.category')
            ->whereHas('booking', fn ($q) => $q->where('user_id', request()->user()->id))
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $payment,
        ]);
    }

    public function uploadProof(Request $request, int $id)
    {
        $payment = Payment::whereHas('booking', fn ($q) => $q->where('user_id', $request->user()->id))
            ->findOrFail($id);

        if ($payment->status === 'paid') {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran sudah diverifikasi',
            ], 422);
        }

        $request->validate([
            'proof_image' => 'required|string|max:500',
        ]);

        $updated = $this->paymentService->uploadProof($payment, $request->proof_image);
        
        return response()->json([
            'success' => true,
            'message' => 'Bukti pembayaran berhasil diunggah, menunggu verifikasi',
            'data' => $updated,
        ]);
    }

    public function index(Request $request)
    {
        $payments = Payment::with('booking.car.category', 'booking.user')
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate($request->get('per_page', 20))
            ->withQueryString();

        return response()->json([
            'success' => true,
            'data' => $payments,
        ]);
    }

    public function verify(Request $request, int $id)
    {
        $payment = Payment::findOrFail($id);
        $updated = $this->paymentService->verifyPayment($payment);
        
        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil diverifikasi',
            'data' => $updated,
        ]);
    }

    public function reject(Request $request, int $id)
    {
        $payment = Payment::findOrFail($id);
        $updated = $this->paymentService->rejectPayment($payment);
        
        return response()->json([
            'success' => true,
            'message' => 'Pembayaran ditolak',
            'data' => $updated,
        ]);
    }

    public function updateStatus(Request $request, int $id)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,failed,refunded',
        ]);

        $payment = Payment::findOrFail($id);
        
        match ($request->status) {
            'paid' => $this->paymentService->verifyPayment($payment),
            'failed' => $this->paymentService->rejectPayment($payment),
            'refunded' => $this->paymentService->refundPayment($payment),
            default => $payment->update(['status' => $request->status]),
        };

        return response()->json([
            'success' => true,
            'message' => 'Status pembayaran diperbarui',
            'data' => $payment->load('booking'),
        ]);
    }
}
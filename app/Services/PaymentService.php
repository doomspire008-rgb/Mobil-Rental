<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    public function createPayment(int $bookingId, array $data): Payment
    {
        $booking = Booking::findOrFail($bookingId);
        
        if ($booking->payment) {
            throw new \Exception('Pembayaran sudah dibuat untuk booking ini');
        }

        return DB::transaction(function () use ($booking, $data) {
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'amount' => $data['amount'] ?? $booking->total_price,
                'status' => 'pending',
                'method' => $data['method'] ?? null,
                'transaction_id' => $data['transaction_id'] ?? null,
            ]);

            return $payment->load('booking');
        });
    }

    public function uploadProof(Payment $payment, string $proofPath): Payment
    {
        return DB::transaction(function () use ($payment, $proofPath) {
            $payment->update([
                'proof_image' => $proofPath,
                'status' => 'pending',
            ]);

            return $payment->load('booking');
        });
    }

    public function verifyPayment(Payment $payment): Payment
    {
        return DB::transaction(function () use ($payment) {
            $payment->update([
                'status' => 'paid',
                'payment_date' => now(),
            ]);

            $booking = $payment->booking;
            if ($booking && in_array($booking->status, ['pending', 'confirmed'])) {
                $booking->update(['status' => 'confirmed']);
            }

            return $payment->load('booking');
        });
    }

    public function rejectPayment(Payment $payment): Payment
    {
        return DB::transaction(function () use ($payment) {
            $payment->update([
                'status' => 'failed',
            ]);

            return $payment->load('booking');
        });
    }

    public function refundPayment(Payment $payment): Payment
    {
        return DB::transaction(function () use ($payment) {
            $payment->update([
                'status' => 'refunded',
            ]);

            return $payment->load('booking');
        });
    }
}
<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingService
{
    public function checkAvailability(int $carId, string $startDate, string $endDate): bool
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        $overlapping = Booking::where('car_id', $carId)
            ->whereNotIn('status', ['cancelled', 'completed', 'rejected'])
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_date', [$start, $end])
                    ->orWhereBetween('end_date', [$start, $end])
                    ->orWhere(function ($q) use ($start, $end) {
                        $q->where('start_date', '<=', $start)
                            ->where('end_date', '>=', $end);
                    });
            })
            ->exists();

        if ($overlapping) {
            return false;
        }

        $car = Car::find($carId);
        if (!$car || !$car->is_available || $car->status !== 'available') {
            return false;
        }

        $activeBookings = Booking::where('car_id', $carId)
            ->where('status', 'active')
            ->count();

        return $activeBookings < $car->stock;
    }

    public function createBooking(int $userId, array $data): Booking
    {
        $car = Car::findOrFail($data['car_id']);
        
        if (!$this->checkAvailability($car->id, $data['start_date'], $data['end_date'])) {
            throw new \Exception('Mobil tidak tersedia pada tanggal tersebut');
        }

        $startDate = Carbon::parse($data['start_date']);
        $endDate = Carbon::parse($data['end_date']);
        $days = $startDate->diffInDays($endDate) + 1;
        $totalPrice = $car->price_per_day * $days;
        $deposit = $totalPrice * 0.1;

        return DB::transaction(function () use ($userId, $car, $data, $totalPrice, $deposit) {
            $booking = Booking::create([
                'user_id' => $userId,
                'car_id' => $car->id,
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'pickup_time' => $data['pickup_time'] ?? null,
                'return_time' => $data['return_time'] ?? null,
                'total_price' => $totalPrice,
                'deposit' => $deposit,
                'status' => 'pending',
                'notes' => $data['notes'] ?? null,
                'pickup_location' => $data['pickup_location'] ?? null,
                'return_location' => $data['return_location'] ?? null,
            ]);

            if ($car->stock <= 1) {
                $car->update(['status' => 'rented']);
            }

            return $booking->load(['car.category', 'user']);
        });
    }

    public function cancelBooking(Booking $booking): Booking
    {
        return DB::transaction(function () use ($booking) {
            $booking->update(['status' => 'cancelled']);
            
            $car = Car::find($booking->car_id);
            if ($car && $car->status === 'rented') {
                $activeBookings = Booking::where('car_id', $car->id)
                    ->where('status', 'active')
                    ->count();
                
                if ($activeBookings === 0) {
                    $car->update(['status' => 'available']);
                }
            }

            return $booking;
        });
    }

    public function updateBookingStatus(Booking $booking, string $status): Booking
    {
        $validStatuses = ['pending', 'confirmed', 'processing', 'active', 'completed', 'cancelled', 'rejected'];
        
        if (!in_array($status, $validStatuses)) {
            throw new \Exception('Status tidak valid');
        }

        return DB::transaction(function () use ($booking, $status) {
            $booking->update(['status' => $status]);
            
            $car = Car::find($booking->car_id);
            
            if ($status === 'active' && $car) {
                $car->update(['status' => 'rented']);
            } elseif (in_array($status, ['completed', 'cancelled', 'rejected']) && $car) {
                $activeBookings = Booking::where('car_id', $car->id)
                    ->where('status', 'active')
                    ->count();
                
                if ($activeBookings === 0) {
                    $car->update(['status' => 'available']);
                }
            }

            return $booking->load(['car.category', 'user', 'payment']);
        });
    }
}
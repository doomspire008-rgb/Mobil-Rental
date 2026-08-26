<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $bookings = Booking::where('status', 'completed')->with('user', 'car')->get();

        $sampleReviews = [
            [
                'rating' => 5,
                'comment' => 'Pelayanan luar biasa! Mobil Toyota Avanza kondisinya sangat prima, bersih, dan AC dingin sekali. Proses serah terima di bandara sangat tepat waktu. Pasti akan sewa di sini lagi saat ke Jakarta.',
            ],
            [
                'rating' => 5,
                'comment' => 'Fortuner 2.8 GR Sport sangat bertenaga untuk perjalanan keluarga ke Puncak. Driver ramah dan profesional, rute perjalanan nyaman dan aman. Sangat direkomendasikan untuk rental eksekutif.',
            ],
        ];

        foreach ($bookings as $index => $booking) {
            if (isset($sampleReviews[$index])) {
                Review::create([
                    'booking_id' => $booking->id,
                    'user_id' => $booking->user_id,
                    'car_id' => $booking->car_id,
                    'rating' => $sampleReviews[$index]['rating'],
                    'comment' => $sampleReviews[$index]['comment'],
                ]);
            }
        }
    }
}

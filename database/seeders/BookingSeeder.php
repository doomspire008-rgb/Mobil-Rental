<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $john = User::where('email', 'john@example.com')->first();
        $jane = User::where('email', 'jane@example.com')->first();
        $cars = Car::all();

        if ($cars->count() < 3 || !$john || !$jane) {
            return;
        }

        $bookings = [
            [
                'user_id' => $john->id,
                'car_id' => $cars[0]->id, // Avanza
                'start_date' => Carbon::now()->subDays(10),
                'end_date' => Carbon::now()->subDays(7),
                'pickup_time' => '09:00',
                'return_time' => '18:00',
                'total_price' => 1350000,
                'deposit' => 300000,
                'status' => 'completed',
                'pickup_location' => 'Bandara Soekarno-Hatta (CGK)',
                'return_location' => 'Bandara Soekarno-Hatta (CGK)',
                'notes' => 'Antar tepat waktu di Terminal 3.',
            ],
            [
                'user_id' => $jane->id,
                'car_id' => $cars[1]->id, // Fortuner
                'start_date' => Carbon::now()->subDays(5),
                'end_date' => Carbon::now()->subDays(2),
                'pickup_time' => '08:00',
                'return_time' => '20:00',
                'total_price' => 3750000,
                'deposit' => 500000,
                'status' => 'completed',
                'pickup_location' => 'Hotel Indonesia Kempinski Jakarta',
                'return_location' => 'Hotel Indonesia Kempinski Jakarta',
                'notes' => 'Mobil bersih dan harum.',
            ],
            [
                'user_id' => $john->id,
                'car_id' => $cars[2]->id, // Innova Zenix
                'start_date' => Carbon::now()->subDays(1),
                'end_date' => Carbon::now()->addDays(2),
                'pickup_time' => '10:00',
                'return_time' => '17:00',
                'total_price' => 2550000,
                'deposit' => 500000,
                'status' => 'active',
                'pickup_location' => 'Stasiun Gambir',
                'return_location' => 'Stasiun Gambir',
                'notes' => 'Sewa lepas kunci untuk liburan keluarga di Bandung.',
            ],
            [
                'user_id' => $jane->id,
                'car_id' => $cars[5]->id, // BMW 530i
                'start_date' => Carbon::now()->addDays(3),
                'end_date' => Carbon::now()->addDays(5),
                'pickup_time' => '07:30',
                'return_time' => '21:00',
                'total_price' => 5400000,
                'deposit' => 1000000,
                'status' => 'pending',
                'pickup_location' => 'SCBD Jakarta Selatan',
                'return_location' => 'SCBD Jakarta Selatan',
                'notes' => 'Kebutuhan VIP meeting rekanan bisnis.',
            ],
        ];

        foreach ($bookings as $booking) {
            Booking::create($booking);
        }
    }
}

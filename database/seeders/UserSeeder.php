<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'doomspire008@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '081299779053',
            'address' => 'Jl. Seteran Tengah No. 9, Semarang',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'phone' => '081234567891',
            'address' => 'Jakarta Selatan',
            'ktp_number' => '3171012345678901',
            'driver_license' => 'D1234567890',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'phone' => '081234567892',
            'address' => 'Bandung',
            'ktp_number' => '3273012345678902',
            'driver_license' => 'D1234567891',
            'email_verified_at' => now(),
        ]);
    }
}

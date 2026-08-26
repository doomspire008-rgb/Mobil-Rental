<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            CarSeeder::class,
            BookingSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}

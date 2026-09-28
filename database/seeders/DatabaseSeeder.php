<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;
use App\Models\Car;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (Category::count() === 0) {
            $this->call(CategorySeeder::class);
        }

        if (User::count() === 0) {
            $this->call(UserSeeder::class);
        }

        if (Car::count() === 0) {
            $this->call(CarSeeder::class);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Sedan', 'slug' => 'sedan', 'icon' => 'car'],
            ['name' => 'SUV', 'slug' => 'suv', 'icon' => 'truck'],
            ['name' => 'MPV', 'slug' => 'mpv', 'icon' => 'users'],
            ['name' => 'Hatchback', 'slug' => 'hatchback', 'icon' => 'car'],
            ['name' => 'Luxury', 'slug' => 'luxury', 'icon' => 'crown'],
            ['name' => 'Electric', 'slug' => 'electric', 'icon' => 'bolt'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

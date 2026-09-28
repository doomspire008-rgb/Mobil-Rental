<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $sedan = Category::where('slug', 'sedan')->first();
        $suv = Category::where('slug', 'suv')->first();
        $mpv = Category::where('slug', 'mpv')->first();
        $hatchback = Category::where('slug', 'hatchback')->first();
        $luxury = Category::where('slug', 'luxury')->first();
        $electric = Category::where('slug', 'electric')->first();

        $cars = [
            [
                'category_id' => $mpv->id,
                'name' => 'Toyota Avanza',
                'brand' => 'Toyota',
                'model' => 'Avanza 1.5 G',
                'year' => 2023,
                'plate_number' => 'B 1234 ABC',
                'price_per_day' => 500000,
                'description' => 'MPV keluarga yang nyaman dan irit bahan bakar. Cocok untuk perjalanan jauh dengan keluarga.',
                'image' => 'https://images.unsplash.com/photo-1603584173870-7f23fdae1b7a?w=800',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1603584173870-7f23fdae1b7a?w=800',
                    'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=800',
                ],
                'status' => 'available',
                'seats' => 7,
                'transmission' => 'automatic',
                'fuel_type' => 'bensin',
                'is_available' => true,
                'stock' => 3,
            ],
            [
                'category_id' => $suv->id,
                'name' => 'Toyota Fortuner',
                'brand' => 'Toyota',
                'model' => 'Fortuner 2.4 VRZ',
                'year' => 2023,
                'plate_number' => 'B 2345 BCD',
                'price_per_day' => 1200000,
                'description' => 'SUV premium dengan performa tangguh. Cocok untuk off-road dan perjalanan bisnis.',
                'image' => 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800',
                    'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=800',
                ],
                'status' => 'available',
                'seats' => 7,
                'transmission' => 'automatic',
                'fuel_type' => 'diesel',
                'is_available' => true,
                'stock' => 2,
            ],
            [
                'category_id' => $sedan->id,
                'name' => 'Honda Civic',
                'brand' => 'Honda',
                'model' => 'Civic RS Turbo',
                'year' => 2023,
                'plate_number' => 'B 3456 CDE',
                'price_per_day' => 800000,
                'description' => 'Sedan sporty dengan mesin turbo yang powerful. Desain modern dan interior mewah.',
                'image' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800',
                    'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800',
                ],
                'status' => 'available',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'bensin',
                'is_available' => true,
                'stock' => 2,
            ],
            [
                'category_id' => $suv->id,
                'name' => 'Mitsubishi Xpander',
                'brand' => 'Mitsubishi',
                'model' => 'Xpander Cross',
                'year' => 2023,
                'plate_number' => 'B 4567 DEF',
                'price_per_day' => 600000,
                'description' => 'Crossover praktis dengan ground clearance tinggi. Cocok untuk jalanan Indonesia.',
                'image' => 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?w=800',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?w=800',
                ],
                'status' => 'available',
                'seats' => 7,
                'transmission' => 'automatic',
                'fuel_type' => 'bensin',
                'is_available' => true,
                'stock' => 4,
            ],
            [
                'category_id' => $luxury->id,
                'name' => 'BMW 5 Series',
                'brand' => 'BMW',
                'model' => '530i M Sport',
                'year' => 2023,
                'plate_number' => 'B 5678 EFG',
                'price_per_day' => 2500000,
                'description' => 'Sedan mewah kelas eksekutif dengan performa superior dan interior premium.',
                'image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800',
                    'https://images.unsplash.com/photo-1617531653332-bd46c24f2068?w=800',
                ],
                'status' => 'available',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'bensin',
                'is_available' => true,
                'stock' => 1,
            ],
            [
                'category_id' => $electric->id,
                'name' => 'Tesla Model 3',
                'brand' => 'Tesla',
                'model' => 'Model 3 Long Range',
                'year' => 2023,
                'plate_number' => 'B 6789 FGH',
                'price_per_day' => 1500000,
                'description' => 'Mobil listrik premium dengan range jarak tempuh jauh dan teknologi autopilot.',
                'image' => 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?w=800',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1560958089-b8a1929cea89?w=800',
                    'https://images.unsplash.com/photo-1626622763183-a7849b52a29b?w=800',
                ],
                'status' => 'available',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'electric',
                'is_available' => true,
                'stock' => 1,
            ],
            [
                'category_id' => $hatchback->id,
                'name' => 'Toyota Yaris',
                'brand' => 'Toyota',
                'model' => 'Yaris 1.5 G',
                'year' => 2023,
                'plate_number' => 'B 7890 GHI',
                'price_per_day' => 400000,
                'description' => 'Hatchback compact yang lincah di kota. Irit bahan bakar dan mudah parkir.',
                'image' => 'https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?w=800',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?w=800',
                ],
                'status' => 'available',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'bensin',
                'is_available' => true,
                'stock' => 3,
            ],
            [
                'category_id' => $mpv->id,
                'name' => 'Daihatsu Xenia',
                'brand' => 'Daihatsu',
                'model' => 'Xenia 1.5 R Deluxe',
                'year' => 2022,
                'plate_number' => 'B 8901 HIJ',
                'price_per_day' => 450000,
                'description' => 'MPV ekonomis dengan kapasitas 7 penumpang. Harga terjangkau untuk keluarga.',
                'image' => 'https://images.unsplash.com/photo-1603584173870-7f23fdae1b7a?w=800',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1603584173870-7f23fdae1b7a?w=800',
                ],
                'status' => 'available',
                'seats' => 7,
                'transmission' => 'automatic',
                'fuel_type' => 'bensin',
                'is_available' => true,
                'stock' => 2,
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}

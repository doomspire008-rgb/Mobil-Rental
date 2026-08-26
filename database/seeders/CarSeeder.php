<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Category;
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
                'name' => 'Toyota Avanza 1.5 G',
                'brand' => 'Toyota',
                'model' => 'Avanza Facelift',
                'year' => 2024,
                'plate_number' => 'B 1420 SSK',
                'price_per_day' => 450000,
                'description' => 'MPV keluarga terfavorit di Indonesia. Nyaman, kabin lega untuk 7 penumpang, hemat BBM, dan dilengkapi fitur keselamatan Toyota Safety Sense.',
                'image' => 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=800&auto=format&fit=crop&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=800&auto=format&fit=crop&q=80',
                    'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&auto=format&fit=crop&q=80',
                ],
                'status' => 'available',
                'seats' => 7,
                'transmission' => 'automatic',
                'fuel_type' => 'bensin',
                'is_available' => true,
                'stock' => 5,
            ],
            [
                'category_id' => $suv->id,
                'name' => 'Toyota Fortuner 2.8 GR Sport',
                'brand' => 'Toyota',
                'model' => 'Fortuner 4x2',
                'year' => 2024,
                'plate_number' => 'B 8899 LUX',
                'price_per_day' => 1250000,
                'description' => 'High SUV berkarakter gagah dan tangguh dengan mesin diesel 2.800cc turbo bertenaga. Sangat ideal untuk perjalanan dinas, wisata luar kota, maupun acara formal.',
                'image' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800&auto=format&fit=crop&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800&auto=format&fit=crop&q=80',
                ],
                'status' => 'available',
                'seats' => 7,
                'transmission' => 'automatic',
                'fuel_type' => 'diesel',
                'is_available' => true,
                'stock' => 3,
            ],
            [
                'category_id' => $mpv->id,
                'name' => 'Toyota Innova Zenix Hybrid',
                'brand' => 'Toyota',
                'model' => 'Zenix Q Modellista',
                'year' => 2024,
                'plate_number' => 'B 7777 ZNX',
                'price_per_day' => 850000,
                'description' => 'Generasi terbaru Innova berteknologi Hybrid TNGA. Suspensi super empuk layaknya sedan mewah, panoramic sunroof, dan kursi captain seat elektrik.',
                'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&auto=format&fit=crop&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&auto=format&fit=crop&q=80',
                ],
                'status' => 'available',
                'seats' => 7,
                'transmission' => 'automatic',
                'fuel_type' => 'hybrid',
                'is_available' => true,
                'stock' => 4,
            ],
            [
                'category_id' => $sedan->id,
                'name' => 'Honda Civic RS Turbo',
                'brand' => 'Honda',
                'model' => 'Civic Sedan RS',
                'year' => 2023,
                'plate_number' => 'B 1188 CVC',
                'price_per_day' => 850000,
                'description' => 'Sedan sporty premium dengan performa 1.5L VTEC Turbo. Desain aerodinamis modern, audio BOSE premium, dan fitur Honda SENSING canggih.',
                'image' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800&auto=format&fit=crop&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800&auto=format&fit=crop&q=80',
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
                'name' => 'Mitsubishi Xpander Cross',
                'brand' => 'Mitsubishi',
                'model' => 'Xpander Cross Premium',
                'year' => 2023,
                'plate_number' => 'B 2341 XPD',
                'price_per_day' => 550000,
                'description' => 'Crossover tangguh dengan ground clearance 225mm. Dilengkapi Active Yaw Control (AYC) dan kekedapan kabin terbaik di kelasnya.',
                'image' => 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?w=800&auto=format&fit=crop&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?w=800&auto=format&fit=crop&q=80',
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
                'name' => 'BMW 5 Series 530i M Sport',
                'brand' => 'BMW',
                'model' => '530i G30 LCI',
                'year' => 2023,
                'plate_number' => 'B 5555 MGR',
                'price_per_day' => 2700000,
                'description' => 'Executive business sedan kelas dunia. Kombinasi kemewahan interior Dakota leather, tenaga TwinPower Turbo 252 hp, dan handling presisi tinggi.',
                'image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&auto=format&fit=crop&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&auto=format&fit=crop&q=80',
                ],
                'status' => 'available',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'bensin',
                'is_available' => true,
                'stock' => 2,
            ],
            [
                'category_id' => $electric->id,
                'name' => 'Tesla Model 3 Long Range',
                'brand' => 'Tesla',
                'model' => 'Model 3 Dual Motor',
                'year' => 2023,
                'plate_number' => 'B 9999 EVX',
                'price_per_day' => 1800000,
                'description' => 'Mobil listrik premium dengan jangkauan lebih dari 550 km sekali pengisian. Akselerasi instan 0-100 km/jam dalam 4.4 detik serta teknologi Autopilot.',
                'image' => 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?w=800&auto=format&fit=crop&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1560958089-b8a1929cea89?w=800&auto=format&fit=crop&q=80',
                ],
                'status' => 'available',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'electric',
                'is_available' => true,
                'stock' => 2,
            ],
            [
                'category_id' => $electric->id,
                'name' => 'Hyundai Ioniq 5 Signature Long Range',
                'brand' => 'Hyundai',
                'model' => 'Ioniq 5',
                'year' => 2024,
                'plate_number' => 'B 3030 ION',
                'price_per_day' => 1400000,
                'description' => 'EV Crossover futuristik berdesain Parametric Pixel dengan kabin ultra-lega, V2L (Vehicle to Load), dan kursi relaksasi premium.',
                'image' => 'https://images.unsplash.com/photo-1502877338535-766e1452684a?w=800&auto=format&fit=crop&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1502877338535-766e1452684a?w=800&auto=format&fit=crop&q=80',
                ],
                'status' => 'available',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'electric',
                'is_available' => true,
                'stock' => 2,
            ],
            [
                'category_id' => $hatchback->id,
                'name' => 'Toyota Yaris 1.5 GR Sport',
                'brand' => 'Toyota',
                'model' => 'Yaris GR Sport',
                'year' => 2023,
                'plate_number' => 'B 7890 GHI',
                'price_per_day' => 450000,
                'description' => 'Hatchback lincah dan gesit bernuansa balap Gazoo Racing. Sangat hemat bahan bakar, mudah bermanuver di jalanan kota dan area parkir sempit.',
                'image' => 'https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?w=800&auto=format&fit=crop&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?w=800&auto=format&fit=crop&q=80',
                ],
                'status' => 'available',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'bensin',
                'is_available' => true,
                'stock' => 3,
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}

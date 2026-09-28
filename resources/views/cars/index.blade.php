@extends('layouts.app')

@section('title', 'Armada Mobil - RentalMobilku')

@section('content')
<div class="pt-24 pb-16" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
    <div class="container-custom">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Armada Mobil</h1>
        <p class="text-slate-400">Pilih mobil terbaik untuk perjalanan Anda</p>
    </div>
</div>

<section class="section">
    <div class="container-custom">
        <div class="grid lg:grid-cols-4 gap-8">
            <aside class="lg:col-span-1">
                <form method="GET" action="{{ route('cars.index') }}" class="bg-white p-6 rounded-2xl border border-neutral-100 space-y-4 sticky top-24">
                    <div>
                        <label class="label">Cari</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama, merk, model..." class="input">
                    </div>
                    <div>
                        <label class="label">Kategori</label>
                        <select name="category" class="input">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>{{ $cat->name }} ({{ $cat->cars_count }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="label">Transmisi</label>
                        <select name="transmission" class="input">
                            <option value="">Semua</option>
                            <option value="automatic" {{ request('transmission') === 'automatic' ? 'selected' : '' }}>Automatic</option>
                            <option value="manual" {{ request('transmission') === 'manual' ? 'selected' : '' }}>Manual</option>
                        </select>
                    </div>
                    <div>
                        <label class="label">Bahan Bakar</label>
                        <select name="fuel_type" class="input">
                            <option value="">Semua</option>
                            <option value="bensin" {{ request('fuel_type') === 'bensin' ? 'selected' : '' }}>Bensin</option>
                            <option value="diesel" {{ request('fuel_type') === 'diesel' ? 'selected' : '' }}>Diesel</option>
                            <option value="electric" {{ request('fuel_type') === 'electric' ? 'selected' : '' }}>Electric</option>
                        </select>
                    </div>
                    <div>
                        <label class="label">Harga per Hari</label>
                        <div class="flex gap-2">
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="input">
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="input">
                        </div>
                    </div>
                    <button type="submit" class="btn-primary w-full">Filter</button>
                    <a href="{{ route('cars.index') }}" class="btn-outline w-full text-center">Reset</a>
                </form>
            </aside>

            <div class="lg:col-span-3">
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($cars as $car)
                    <a href="{{ route('cars.show', $car->id) }}" class="bg-white rounded-2xl border border-neutral-100 overflow-hidden hover:-translate-y-1 hover:shadow-xl transition-all duration-300 group">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $car->image }}" alt="{{ $car->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-3 left-3 badge-primary">{{ $car->category->name }}</span>
                            @if($car->is_available)
                            <span class="absolute top-3 right-3 badge-success">Tersedia</span>
                            @else
                            <span class="absolute top-3 right-3 badge-danger">Disewa</span>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="font-semibold text-neutral-900 mb-1">{{ $car->name }}</h3>
                            <p class="text-xs text-neutral-400 mb-3">{{ $car->brand }} {{ $car->model }} &middot; {{ $car->year }}</p>
                            <div class="flex items-center gap-3 mb-3 text-xs text-neutral-500">
                                <span>{{ $car->seats }} kursi</span>
                                <span>{{ $car->transmission === 'automatic' ? 'AT' : 'MT' }}</span>
                                <span>{{ ucfirst($car->fuel_type) }}</span>
                            </div>
                            <div class="flex items-center justify-between pt-3 border-t border-neutral-100">
                                <span class="text-lg font-bold" style="color: #16a34a;">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</span>
                                <span class="text-xs text-neutral-400">/hari</span>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="col-span-full text-center py-16">
                        <p class="text-neutral-400 text-lg">Mobil tidak ditemukan.</p>
                    </div>
                    @endforelse
                </div>
                <div class="mt-8">
                    {{ $cars->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
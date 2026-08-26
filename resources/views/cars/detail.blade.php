@extends('layouts.app')

@section('title', $car->name . ' - Detail & Sewa Mobil - RentalMobilku')

@section('content')
<!-- Header Breadcrumb Banner -->
<section class="bg-slate-950 text-white pt-28 pb-8">
    <div class="container-custom">
        <nav class="flex items-center gap-2 text-xs text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('cars.index') }}" class="hover:text-white transition-colors">Armada</a>
            <span>/</span>
            <span class="text-slate-200 font-semibold">{{ $car->name }}</span>
        </nav>
    </div>
</section>

<!-- Detail Content -->
<section class="py-12 bg-slate-50">
    <div class="container-custom">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left 2 Cols: Gallery, Specs, Description -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Vehicle Card -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <div class="relative h-72 sm:h-96 overflow-hidden bg-slate-100">
                        <img src="{{ $car->image }}" alt="{{ $car->name }}" class="w-full h-full object-cover">
                        <span class="absolute top-4 left-4 badge-primary font-bold text-xs shadow-xs">{{ $car->category->name }}</span>
                        @if($car->is_available)
                            <span class="absolute top-4 right-4 badge-success bg-emerald-500 text-white border-0 text-xs shadow-xs">Unit Tersedia</span>
                        @else
                            <span class="absolute top-4 right-4 badge-danger bg-red-500 text-white border-0 text-xs shadow-xs">Sedang Disewa</span>
                        @endif
                    </div>

                    <div class="p-6 sm:p-8">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4">
                            <div>
                                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900">{{ $car->name }}</h1>
                                <p class="text-slate-500 text-sm mt-0.5">{{ $car->brand }} {{ $car->model }} &middot; Tahun Produksi {{ $car->year }} &middot; Plat: <span class="font-mono font-bold text-slate-700">{{ $car->plate_number }}</span></p>
                            </div>
                        </div>

                        <!-- 3 Specs Box -->
                        <div class="grid grid-cols-3 gap-4 my-6">
                            <div class="text-center p-4 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="text-xl block mb-1">👥</span>
                                <p class="text-xs text-slate-400 font-medium">Kapasitas</p>
                                <p class="text-sm font-bold text-slate-900">{{ $car->seats }} Penumpang</p>
                            </div>
                            <div class="text-center p-4 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="text-xl block mb-1">⚙️</span>
                                <p class="text-xs text-slate-400 font-medium">Transmisi</p>
                                <p class="text-sm font-bold text-slate-900">{{ ucfirst($car->transmission) }}</p>
                            </div>
                            <div class="text-center p-4 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="text-xl block mb-1">⛽</span>
                                <p class="text-xs text-slate-400 font-medium">Bahan Bakar</p>
                                <p class="text-sm font-bold text-slate-900">{{ ucfirst($car->fuel_type) }}</p>
                            </div>
                        </div>

                        <!-- Description -->
                        <h2 class="font-bold text-slate-900 text-base mb-2">Deskripsi & Keunggulan</h2>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6">{{ $car->description }}</p>

                        <!-- Highlights -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-6 border-t border-slate-100 text-xs text-slate-600 font-medium">
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span> AC Dingin & Kabin Steril Higienis
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span> Asuransi All-Risk Komprehensif
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span> Bantuan Darurat Jalan Raya 24 Jam
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span> Audio Bluetooth & USB Charger Port
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer Reviews Section -->
                @if($car->reviews->count() > 0)
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
                    <h3 class="font-bold text-slate-900 text-base mb-4">Ulasan Pelanggan ({{ $car->reviews->count() }})</h3>
                    <div class="space-y-4">
                        @foreach($car->reviews as $review)
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                            <div class="flex items-center gap-1 text-amber-400 mb-1.5 text-sm">
                                @for($i = 0; $i < $review->rating; $i++)
                                    <span>★</span>
                                @endfor
                            </div>
                            <p class="text-slate-700 text-xs sm:text-sm italic mb-2">"{{ $review->comment }}"</p>
                            <p class="text-[11px] text-slate-400 font-medium">Oleh {{ $review->user->name ?? 'Pelanggan' }} &middot; {{ $review->created_at->diffForHumans() }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Right 1 Col: Booking Card Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xl sticky top-24 space-y-6">
                    <div class="text-center pb-5 border-b border-slate-100">
                        <span class="text-xs text-slate-400 block mb-1">Tarif Sewa Harian</span>
                        <p class="text-3xl font-extrabold text-blue-600">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-500 mt-0.5">Sudah termasuk asuransi all-risk</p>
                    </div>

                    <!-- Direct Action Buttons -->
                    <div class="space-y-3">
                        <a href="https://wa.me/6281299779053?text={{ urlencode('Halo RentalMobilku, saya ingin menyewa ' . $car->name . ' (Plat: ' . $car->plate_number . '). Apakah unit tersedia?') }}" 
                           target="_blank" 
                           class="btn-primary w-full py-3.5 flex items-center justify-center gap-2 font-bold">
                            💬 Pesan via WhatsApp CS
                        </a>
                        
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn-secondary w-full py-2.5 text-xs text-center">
                                Cek Riwayat Booking Saya
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-outline w-full py-2.5 text-xs text-center">
                                Masuk untuk Booking Otomatis
                            </a>
                        @endauth
                    </div>

                    <!-- Trust Checklist -->
                    <div class="space-y-2.5 pt-4 border-t border-slate-100 text-xs text-slate-600">
                        <div class="flex items-center gap-2">
                            <span class="text-blue-600 font-bold">🛡️</span> Asuransi All-Risk & TLO
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-blue-600 font-bold">⚡</span> Konfirmasi Instan < 15 Menit
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-blue-600 font-bold">🔄</span> Gratis Reschedule s/d 24 Jam
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
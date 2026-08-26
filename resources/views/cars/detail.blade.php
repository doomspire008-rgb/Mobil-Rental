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
                            <div class="text-center p-4 rounded-xl bg-slate-50 border border-slate-100 flex flex-col items-center justify-center">
                                <svg class="w-6 h-6 text-slate-500 mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <p class="text-xs text-slate-400 font-medium">Kapasitas</p>
                                <p class="text-sm font-bold text-slate-900">{{ $car->seats }} Penumpang</p>
                            </div>
                            <div class="text-center p-4 rounded-xl bg-slate-50 border border-slate-100 flex flex-col items-center justify-center">
                                <svg class="w-6 h-6 text-slate-500 mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <p class="text-xs text-slate-400 font-medium">Transmisi</p>
                                <p class="text-sm font-bold text-slate-900">{{ ucfirst($car->transmission) }}</p>
                            </div>
                            <div class="text-center p-4 rounded-xl bg-slate-50 border border-slate-100 flex flex-col items-center justify-center">
                                <svg class="w-6 h-6 text-slate-500 mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
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
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> AC Dingin & Kabin Steril Higienis
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Asuransi All-Risk Komprehensif
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Bantuan Darurat Jalan Raya 24 Jam
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Audio Bluetooth & USB Charger Port
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
                                    <svg class="w-4 h-4 text-amber-400 fill-amber-400" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
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
                            <svg class="w-4 h-4 text-white fill-white" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.665-.699c.971.53 1.771.821 2.795.821 3.181 0 5.767-2.587 5.768-5.766.001-3.182-2.585-5.768-5.768-5.768zm0-2.172c4.418 0 8 3.582 8 8s-3.582 8-8 8c-1.393 0-2.695-.357-3.832-.984l-4.168 1.094 1.116-4.075c-.702-1.196-1.116-2.584-1.116-4.035 0-4.418 3.582-8 8-8z"/></svg>
                            Pesan via WhatsApp CS
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
                            <svg class="w-4 h-4 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            Asuransi All-Risk & TLO
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            Konfirmasi Instan < 15 Menit
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            Gratis Reschedule s/d 24 Jam
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@extends('layouts.app')

@section('title', $car->name . ' - RentalMobilku')

@section('content')
<div class="pt-24 pb-8" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
    <div class="container-custom">
        <nav class="flex items-center gap-2 text-sm text-slate-400 mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('cars.index') }}" class="hover:text-white transition-colors">Armada</a>
            <span>/</span>
            <span class="text-white">{{ $car->name }}</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container-custom">
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-neutral-100 overflow-hidden">
                    <div class="relative h-80 md:h-96 overflow-hidden">
                        <img src="{{ $car->image }}" alt="{{ $car->name }}" class="w-full h-full object-cover">
                        <span class="absolute top-4 left-4 badge-primary text-sm">{{ $car->category->name }}</span>
                        @if($car->is_available)
                        <span class="absolute top-4 right-4 badge-success text-sm">Tersedia</span>
                        @else
                        <span class="absolute top-4 right-4 badge-danger text-sm">Tidak Tersedia</span>
                        @endif
                    </div>
                    <div class="p-6 md:p-8">
                        <h1 class="text-2xl md:text-3xl font-bold text-neutral-900 mb-2">{{ $car->name }}</h1>
                        <p class="text-neutral-500 mb-6">{{ $car->brand }} {{ $car->model }} &middot; {{ $car->year }}</p>

                        <div class="grid grid-cols-3 gap-4 mb-6">
                            <div class="text-center p-4 rounded-xl bg-neutral-50">
                                <svg class="w-6 h-6 mx-auto mb-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <p class="text-sm font-medium text-neutral-900">{{ $car->seats }} Kursi</p>
                            </div>
                            <div class="text-center p-4 rounded-xl bg-neutral-50">
                                <svg class="w-6 h-6 mx-auto mb-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <p class="text-sm font-medium text-neutral-900">{{ $car->transmission === 'automatic' ? 'Automatic' : 'Manual' }}</p>
                            </div>
                            <div class="text-center p-4 rounded-xl bg-neutral-50">
                                <svg class="w-6 h-6 mx-auto mb-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                <p class="text-sm font-medium text-neutral-900">{{ ucfirst($car->fuel_type) }}</p>
                            </div>
                        </div>

                        <h3 class="font-semibold text-neutral-900 mb-3">Deskripsi</h3>
                        <p class="text-neutral-500 leading-relaxed">{{ $car->description }}</p>

                        <div class="mt-6 pt-6 border-t border-neutral-100">
                            <div class="flex items-center gap-4 text-sm text-neutral-500">
                                <span>Plat: <strong class="text-neutral-700">{{ $car->plate_number }}</strong></span>
                                <span>Stok: <strong class="text-neutral-700">{{ $car->stock }}</strong></span>
                            </div>
                        </div>
                    </div>
                </div>

                @if($car->reviews->count() > 0)
                <div class="bg-white rounded-2xl border border-neutral-100 p-6 md:p-8 mt-6">
                    <h3 class="font-semibold text-neutral-900 mb-6">Ulasan Pelanggan ({{ $car->reviews_count }})</h3>
                    <div class="space-y-4">
                        @foreach($car->reviews->take(5) as $review)
                        <div class="p-4 rounded-xl bg-neutral-50">
                            <div class="flex items-center gap-1 mb-2">
                                @for($i = 0; $i < $review->rating; $i++)
                                <svg class="w-4 h-4" style="color: #facc15;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                            <p class="text-sm text-neutral-600 mb-2">{{ $review->comment }}</p>
                            <p class="text-xs text-neutral-400">oleh {{ $review->user->name }} &middot; {{ $review->created_at->diffForHumans() }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-neutral-100 p-6 sticky top-24">
                    <div class="text-center mb-6">
                        <p class="text-sm text-neutral-400 mb-1">Mulai dari</p>
                        <p class="text-3xl font-bold" style="color: #16a34a;">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</p>
                        <p class="text-sm text-neutral-400">/hari</p>
                    </div>

                    @if($car->is_available)
                    <a href="{{ route('login') }}" class="btn-primary w-full text-center block mb-3">Sewa Sekarang</a>
                    @else
                    <button disabled class="btn w-full text-center opacity-50 cursor-not-allowed" style="background: #ccc; color: #666;">Tidak Tersedia</button>
                    @endif

                    <div class="space-y-3 mt-6 pt-6 border-t border-neutral-100">
                        <div class="flex items-center gap-3 text-sm text-neutral-600">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Asuransi all-risk inklusif
                        </div>
                        <div class="flex items-center gap-3 text-sm text-neutral-600">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Layanan roadside assistance 24/7
                        </div>
                        <div class="flex items-center gap-3 text-sm text-neutral-600">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Gratis antar-jemput
                        </div>
                        <div class="flex items-center gap-3 text-sm text-neutral-600">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Pembatalan gratis 24 jam sebelumnya
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($relatedCars->count() > 0)
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-neutral-900 mb-8">Mobil Serupa</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedCars as $related)
                <a href="{{ route('cars.show', $related->id) }}" class="bg-white rounded-2xl border border-neutral-100 overflow-hidden hover:-translate-y-1 hover:shadow-xl transition-all duration-300 group">
                    <div class="relative h-40 overflow-hidden">
                        <img src="{{ $related->image }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-neutral-900 text-sm">{{ $related->name }}</h3>
                        <p class="text-xs text-neutral-400">{{ $related->brand }} {{ $related->model }}</p>
                        <div class="mt-2">
                            <span class="text-sm font-bold" style="color: #16a34a;">Rp {{ number_format($related->price_per_day, 0, ',', '.') }}</span>
                            <span class="text-xs text-neutral-400">/hari</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
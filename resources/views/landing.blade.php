@extends('layouts.app')

@section('title', 'RentalMobilku - Sewa Mobil Terpercaya & Terjangkau')

@section('content')

<!-- Hero Section -->
<section class="relative min-h-[92vh] flex items-center overflow-hidden pb-32 md:pb-40" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);">
    <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
    <div class="aurora-field">
        <div class="aurora-blob aurora-blob-1 animate-aurora w-96 h-96 -top-10 right-0 opacity-30"></div>
        <div class="aurora-blob aurora-blob-2 animate-aurora w-[28rem] h-[28rem] bottom-0 -left-20 opacity-25" style="animation-delay: -4s;"></div>
        <div class="aurora-blob aurora-blob-3 animate-aurora w-80 h-80 top-1/3 left-1/2 opacity-20" style="animation-delay: -8s;"></div>
        <div class="aurora-blob aurora-blob-5 animate-aurora w-72 h-72 top-10 left-10 opacity-10" style="animation-delay: -2s;"></div>
    </div>

    <div class="container-custom relative z-10 py-20 section-content">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div data-reveal>
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium mb-6" style="background: rgba(34,197,94,0.15); color: #4ade80;">
                    <span class="w-2 h-2 rounded-full" style="background: #22c55e;"></span>
                    Sewa Mobil #1 di Indonesia
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                    Sewa Mobil<br>
                    <span style="background: linear-gradient(135deg, #22c55e 0%, #0ea5e9 45%, #d946ef 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Mudah & Cepat</span>
                </h1>
                <p class="text-lg text-slate-400 mb-8 max-w-lg leading-relaxed">
                    Dapatkan mobil impian Anda dengan harga terbaik dan layanan terpercaya. Tersedia 500+ armada di 25+ kota.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#cari-mobil" class="btn-primary btn-lg">
                        Cari Mobil Sekarang
                    </a>
                    <a href="#cara-kerja" class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-medium rounded-xl border-2 border-slate-500 text-white hover:bg-slate-700 transition-colors">
                        Lihat Cara Kerja
                    </a>
                </div>
                <div class="flex items-center gap-6 mt-10">
                    <div class="flex -space-x-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-green-600 border-2 border-slate-900 flex items-center justify-center text-white text-xs font-bold">J</div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 border-2 border-slate-900 flex items-center justify-center text-white text-xs font-bold">A</div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 border-2 border-slate-900 flex items-center justify-center text-white text-xs font-bold">R</div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 border-2 border-slate-900 flex items-center justify-center text-white text-xs font-bold">+</div>
                    </div>
                    <div>
                        <div class="flex items-center gap-1 mb-1">
                            @for($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4" style="color: #facc15;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <p class="text-slate-400 text-sm">4.9/5 dari 2,500+ pelanggan</p>
                    </div>
                </div>
            </div>
            <div class="hidden lg:block relative" data-reveal>
                <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800&h=500&fit=crop" alt="Sewa Mobil" class="rounded-2xl shadow-2xl w-full" style="border: 1px solid rgba(255,255,255,0.1);">
                <div class="absolute -bottom-6 -left-6 p-4 rounded-xl shadow-xl" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(10px);">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #22c55e, #16a34a);">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-neutral-900">Booking Terverifikasi</p>
                            <p class="text-xs text-neutral-500">1,200+ hari ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Form (kunci utama landing page) -->
    <div id="cari-mobil" class="absolute left-0 right-0 bottom-0 translate-y-1/2 z-20 px-4 scroll-mt-24">
        <div class="container-custom">
            <form method="GET" action="{{ route('cars.index') }}" class="glass rounded-2xl md:rounded-3xl shadow-strong p-5 md:p-8" data-reveal>
                <div class="grid md:grid-cols-4 gap-4 items-end">
                    <div class="md:col-span-2">
                        <label class="label flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Lokasi / Cari Mobil
                        </label>
                        <input type="text" name="search" placeholder="Kota, merk, atau model mobil..." class="input" list="lokasi-suggestions">
                        <datalist id="lokasi-suggestions">
                            <option value="Jakarta"></option>
                            <option value="Bandung"></option>
                            <option value="Surabaya"></option>
                            <option value="Yogyakarta"></option>
                            <option value="Bali"></option>
                        </datalist>
                    </div>
                    <div>
                        <label class="label">Tipe Mobil</label>
                        <select name="category" class="input">
                            <option value="">Semua Tipe</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn-primary btn-lg w-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/></svg>
                        Cari Mobil
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Fitur Unggulan -->
<span id="tentang" class="block -mt-20 pt-20" aria-hidden="true"></span>
<section class="section pt-28 md:pt-36 bg-white relative overflow-hidden" id="fitur">
    <div class="aurora-field opacity-[0.07]">
        <div class="aurora-blob aurora-blob-1 w-96 h-96 -top-20 -right-20"></div>
    </div>
    <div class="container-custom section-content">
        <div class="text-center mb-16" data-reveal>
            <span class="badge-primary mb-4 inline-block">Mengapa Kami?</span>
            <h2 class="text-3xl md:text-4xl font-bold text-neutral-900 mb-4">Layanan Terbaik untuk Anda</h2>
            <p class="text-neutral-500 max-w-2xl mx-auto">Kami berkomitmen memberikan pengalaman sewa mobil terbaik, dari booking hingga Anda kembali di tujuan.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $featureGradients = ['gradient-forest', 'gradient-ocean', 'gradient-royal', 'gradient-secondary'];
            @endphp
            @foreach($features as $feature)
            <div class="p-6 rounded-2xl border border-neutral-100 hover:border-neutral-200 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg bg-white h-full flex flex-col" data-reveal>
                <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-5 {{ $featureGradients[$loop->index % 4] }} shadow-medium">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @if($feature['icon'] === 'shield-check')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        @elseif($feature['icon'] === 'clock')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        @elseif($feature['icon'] === 'map-pin')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        @endif
                    </svg>
                </div>
                <h3 class="font-semibold text-neutral-900 mb-2">{{ $feature['title'] }}</h3>
                <p class="text-sm text-neutral-500 leading-relaxed">{{ $feature['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Mobil Unggulan -->
<span id="harga" class="block -mt-20 pt-20" aria-hidden="true"></span>
<section class="section bg-neutral-50 relative overflow-hidden" id="armada">
    <div class="aurora-field opacity-[0.06]">
        <div class="aurora-blob aurora-blob-2 w-[26rem] h-[26rem] top-0 -left-32"></div>
        <div class="aurora-blob aurora-blob-4 w-80 h-80 bottom-0 right-0"></div>
    </div>
    <div class="container-custom section-content">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-10" data-reveal>
            <div>
                <span class="badge-primary mb-4 inline-block">Armada &amp; Harga</span>
                <h2 class="text-3xl md:text-4xl font-bold text-neutral-900 mb-2">Mobil Unggulan</h2>
                <p class="text-neutral-500">Pilihan terbaik dengan harga transparan untuk perjalanan Anda</p>
            </div>
            <a href="{{ route('cars.index') }}" class="mt-4 sm:mt-0 text-sm font-medium inline-flex items-center gap-2" style="color: #16a34a;">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @if($categories->count())
        <div class="flex flex-wrap gap-2 mb-10" data-reveal>
            <a href="{{ route('cars.index') }}" class="px-4 py-2 rounded-full text-sm font-medium bg-neutral-900 text-white">Semua</a>
            @foreach($categories as $cat)
            <a href="{{ route('cars.index', ['category' => $cat->slug]) }}" class="px-4 py-2 rounded-full text-sm font-medium bg-white border border-neutral-200 text-neutral-600 hover:border-primary-400 hover:text-primary-600 transition-colors">{{ $cat->name }}</a>
            @endforeach
        </div>
        @endif

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredCars as $car)
            <a href="{{ route('cars.show', $car->id) }}" class="bg-white rounded-2xl border border-neutral-100 overflow-hidden hover:-translate-y-1 hover:shadow-xl transition-all duration-300 group h-full flex flex-col" data-reveal>
                <div class="relative h-48 overflow-hidden flex-shrink-0">
                    <img src="{{ $car->image }}" alt="{{ $car->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <span class="absolute top-3 left-3 badge-primary">{{ $car->category->name }}</span>
                    @if($car->is_available)
                    <span class="absolute top-3 right-3 badge-success">Tersedia</span>
                    @else
                    <span class="absolute top-3 right-3 badge-danger">Disewa</span>
                    @endif
                </div>
                <div class="p-5 flex flex-col flex-1">
                    <h3 class="font-semibold text-neutral-900 mb-1">{{ $car->name }}</h3>
                    <p class="text-xs text-neutral-400 mb-3">{{ $car->brand }} {{ $car->model }} &middot; {{ $car->year }}</p>
                    <div class="flex items-center gap-3 mb-3 text-xs text-neutral-500">
                        <span>{{ $car->seats }} kursi</span>
                        <span>{{ $car->transmission === 'automatic' ? 'AT' : 'MT' }}</span>
                        <span>{{ ucfirst($car->fuel_type) }}</span>
                    </div>
                    <div class="flex items-center justify-between pt-3 border-t border-neutral-100 mt-auto">
                        <div>
                            <span class="text-lg font-bold" style="color: #16a34a;">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</span>
                            <span class="text-xs text-neutral-400">/hari</span>
                        </div>
                        @if($car->reviews_avg_rating > 0)
                        <div class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" style="color: #facc15;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <span class="text-xs font-medium text-neutral-700">{{ $car->reviews_avg_rating }}</span>
                        </div>
                        @else
                        <span class="text-xs text-neutral-300">Belum ada rating</span>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Statistik -->
<section class="py-16 md:py-20 relative overflow-hidden" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);">
    <div class="aurora-field">
        <div class="aurora-blob aurora-blob-1 animate-aurora w-80 h-80 top-0 left-10 opacity-20"></div>
        <div class="aurora-blob aurora-blob-3 animate-aurora w-96 h-96 bottom-0 right-10 opacity-15" style="animation-delay: -6s;"></div>
        <div class="aurora-blob aurora-blob-5 animate-aurora w-72 h-72 top-1/2 left-1/2 opacity-10" style="animation-delay: -10s;"></div>
    </div>
    <div class="container-custom section-content">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            @php
                $statIcons = [
                    'cars_count' => ['color' => '#22c55e', 'path' => 'M8 17h8m-8 0a2 2 0 100 4 2 2 0 000-4zm8 0a2 2 0 100 4 2 2 0 000-4zM3 7h13l3 5v5h-2M3 7v9h2M3 7l1.5-3h9L16 7'],
                    'customers_count' => ['color' => '#facc15', 'path' => 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-5.13a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 11-8 0 4 4 0 018 0z'],
                    'bookings_count' => ['color' => '#0ea5e9', 'path' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
                    'cities_count' => ['color' => '#d946ef', 'path' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z'],
                ];
                $statLabels = [
                    'cars_count' => 'Mobil Tersedia',
                    'customers_count' => 'Pelanggan Puas',
                    'bookings_count' => 'Booking Selesai',
                    'cities_count' => 'Kota di Indonesia',
                ];
            @endphp
            @foreach($stats as $key => $value)
            <div class="text-center" data-reveal>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-3" style="background: rgba(255,255,255,0.08);">
                    <svg class="w-6 h-6" style="color: {{ $statIcons[$key]['color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $statIcons[$key]['path'] }}"/></svg>
                </div>
                <div class="text-3xl md:text-4xl font-bold mb-1" style="color: {{ $statIcons[$key]['color'] }};">{{ number_format($value) }}+</div>
                <p class="text-slate-400 text-sm">{{ $statLabels[$key] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Cara Kerja -->
<section class="section bg-white relative overflow-hidden" id="cara-kerja">
    <div class="container-custom section-content">
        <div class="text-center mb-16" data-reveal>
            <span class="badge-secondary mb-4 inline-block">Mudah Digunakan</span>
            <h2 class="text-3xl md:text-4xl font-bold text-neutral-900 mb-4">Cara Sewa Mobil</h2>
            <p class="text-neutral-500 max-w-2xl mx-auto">Hanya 3 langkah sederhana untuk mendapatkan mobil impian Anda.</p>
        </div>
        <div class="relative grid md:grid-cols-3 gap-8">
            <div class="hidden md:block absolute top-8 left-[16.5%] right-[16.5%] h-0.5" style="background: linear-gradient(90deg, #22c55e, #eab308, #0ea5e9); opacity: 0.25;"></div>

            <div class="relative text-center p-8 rounded-2xl border border-neutral-100 hover:border-neutral-200 transition-all hover:shadow-lg bg-white" data-reveal>
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 gradient-forest shadow-medium">
                    <span class="text-2xl font-bold text-white">1</span>
                </div>
                <h3 class="font-semibold text-neutral-900 mb-2">Pilih Mobil</h3>
                <p class="text-sm text-neutral-500">Browse armada kami dan pilih mobil yang sesuai kebutuhan Anda.</p>
            </div>
            <div class="relative text-center p-8 rounded-2xl border border-neutral-100 hover:border-neutral-200 transition-all hover:shadow-lg bg-white" data-reveal>
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 gradient-secondary shadow-medium">
                    <span class="text-2xl font-bold text-white">2</span>
                </div>
                <h3 class="font-semibold text-neutral-900 mb-2">Booking Online</h3>
                <p class="text-sm text-neutral-500">Isi form booking, pilih tanggal, dan lakukan pembayaran.</p>
            </div>
            <div class="relative text-center p-8 rounded-2xl border border-neutral-100 hover:border-neutral-200 transition-all hover:shadow-lg bg-white" data-reveal>
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 gradient-ocean shadow-medium">
                    <span class="text-2xl font-bold text-white">3</span>
                </div>
                <h3 class="font-semibold text-neutral-900 mb-2">Ambil Mobil</h3>
                <p class="text-sm text-neutral-500">Ambil mobil di lokasi yang Anda pilih dan nikmati perjalanan.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimoni -->
<section class="section bg-neutral-50 relative overflow-hidden" id="testimoni">
    <div class="aurora-field opacity-[0.06]">
        <div class="aurora-blob aurora-blob-6 w-96 h-96 top-0 right-0"></div>
        <div class="aurora-blob aurora-blob-5 w-72 h-72 bottom-0 left-0"></div>
    </div>
    <div class="container-custom section-content">
        <div class="text-center mb-16" data-reveal>
            <span class="badge-accent mb-4 inline-block">Testimoni</span>
            <h2 class="text-3xl md:text-4xl font-bold text-neutral-900 mb-4">Apa Kata Mereka?</h2>
            <p class="text-neutral-500 max-w-2xl mx-auto">Ribuan pelanggan puas telah menggunakan layanan kami.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $avatarGradients = ['gradient-forest', 'gradient-secondary', 'gradient-ocean', 'gradient-accent', 'gradient-sunset', 'gradient-royal'];
            @endphp
            @forelse($testimonials as $review)
            <div class="bg-white p-6 rounded-2xl border border-neutral-100 hover:shadow-lg transition-all h-full flex flex-col" data-reveal>
                <svg class="w-8 h-8 mb-3 text-neutral-200" fill="currentColor" viewBox="0 0 32 32"><path d="M10 8c-3.3 0-6 2.7-6 6v10h10V14H8c0-1.1.9-2 2-2V8zm14 0c-3.3 0-6 2.7-6 6v10h10V14h-6c0-1.1.9-2 2-2V8z"/></svg>
                <div class="flex items-center gap-1 mb-4">
                    @for($i = 0; $i < $review->rating; $i++)
                    <svg class="w-4 h-4" style="color: #facc15;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <p class="text-sm text-neutral-600 mb-4 leading-relaxed flex-1">{{ $review->comment }}</p>
                <div class="flex items-center gap-3 pt-4 border-t border-neutral-100">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white text-sm font-bold {{ $avatarGradients[$loop->index % 6] }}">
                        {{ substr($review->user->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium text-neutral-900">{{ $review->user->name }}</p>
                        <p class="text-xs text-neutral-400">{{ $review->car->name }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16 px-6 rounded-2xl border border-dashed border-neutral-200 bg-white">
                <svg class="w-10 h-10 mx-auto mb-3 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                <p class="text-neutral-400">Belum ada testimoni. Jadilah pelanggan pertama yang berbagi cerita!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="section bg-white" id="faq">
    <div class="container-custom max-w-3xl">
        <div class="text-center mb-16" data-reveal>
            <span class="badge-primary mb-4 inline-block">FAQ</span>
            <h2 class="text-3xl md:text-4xl font-bold text-neutral-900 mb-4">Pertanyaan Umum</h2>
            <p class="text-neutral-500">Temukan jawaban untuk pertanyaan yang sering diajukan.</p>
        </div>
        <div class="space-y-4" data-reveal>
            @foreach($faqs as $faq)
            <div class="border border-neutral-200 rounded-xl overflow-hidden hover:border-neutral-300 transition-colors">
                <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between p-5 text-left hover:bg-neutral-50 transition-colors">
                    <span class="font-medium text-neutral-900 pr-4">{{ $faq['question'] }}</span>
                    <svg class="w-5 h-5 text-neutral-400 flex-shrink-0 transition-transform duration-300 faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div class="faq-content hidden px-5 pb-5 border-l-2" style="border-color: #22c55e;">
                    <p class="text-sm text-neutral-500 leading-relaxed">{{ $faq['answer'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 relative overflow-hidden" style="background: linear-gradient(120deg, #22c55e 0%, #0ea5e9 45%, #7c3aed 100%);">
    <div class="aurora-field opacity-40">
        <div class="aurora-blob aurora-blob-5 animate-aurora w-72 h-72 -top-10 left-10"></div>
        <div class="aurora-blob aurora-blob-6 animate-aurora w-80 h-80 -bottom-10 right-10" style="animation-delay: -5s;"></div>
    </div>
    <div class="container-custom text-center section-content">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Siap untuk Perjalanan?</h2>
        <p class="text-white/80 mb-8 max-w-xl mx-auto">Booking sekarang dan dapatkan diskon spesial untuk perjalanan pertama Anda.</p>
        <a href="{{ route('cars.index') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-bold rounded-xl transition-all duration-200 hover:scale-[0.98]" style="background: white; color: #16a34a; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.3);">
            Mulai Sewa Sekarang
        </a>
        <div class="flex flex-wrap justify-center gap-x-8 gap-y-3 mt-10 text-white/80 text-sm">
            <span class="inline-flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Tanpa kartu kredit</span>
            <span class="inline-flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Gratis pembatalan 24 jam</span>
            <span class="inline-flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Support 24/7</span>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function toggleFaq(btn) {
    const content = btn.nextElementSibling;
    const icon = btn.querySelector('.faq-icon');
    const isOpen = !content.classList.contains('hidden');
    document.querySelectorAll('.faq-content').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('.faq-icon').forEach(el => el.style.transform = 'rotate(0deg)');
    if (!isOpen) {
        content.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
    }
}
</script>
@endpush

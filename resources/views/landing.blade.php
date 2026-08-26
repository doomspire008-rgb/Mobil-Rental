@extends('layouts.app')

@section('title', 'RentalMobilku - Sewa Mobil Terpercaya, Aman & Terjangkau di Indonesia')

@section('content')

<!-- 1. HERO SECTION -->
<section class="relative bg-slate-900 text-white overflow-hidden pt-28 pb-16 lg:pt-36 lg:pb-24 border-b border-slate-800/80">


    <!-- Modern Darkened Background Car Wallpaper with Clean Adjustable Overlay -->
    <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
        <img src="https://images.unsplash.com/photo-1727383114270-28aae0ae56e7?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bWF6ZGElMjByeDd8ZW58MHx8MHx8fDA%3D" 
             alt="Hero Background Mobil" 
             class="w-full h-full object-cover object-center"
             style="opacity: 0.5; filter: brightness(0.8) contrast(1.1); transform: scale(1.05);">
        <!-- Dark Overlay Gradient (Menjaga teks tetap terbaca jelas) -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/75 to-slate-900/60"></div>
        <div class="absolute inset-0 bg-slate-950/20"></div>
    </div>

    <div class="container-custom relative z-10">
        <div class="grid lg:grid-cols-12 gap-10 lg:gap-12 items-center">
            <!-- Left Column: Headline & Search Widget -->
            <div class="lg:col-span-7 space-y-6">

                <!-- Main Heading -->
                <h1 class="text-3xl sm:text-5xl lg:text-5xl font-poppins font-semibold tracking-tight leading-[1.2]">
                    Perjalanan Nyaman & Bahagia <span class="text-blue-400">Bersama Keluarga</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-base text-slate-300 max-w-xl font-sansserif font-semibold leading-relaxed">
                    Sewa mobil keluarga, MPV, SUV, dan armada premium dengan kondisi prima, supir terpercaya, dan asuransi all-risk lengkap untuk liburan tanpa khawatir di 25+ kota.
                </p>

                <!-- Interactive Hero Search Widget -->
                <div class="bg-white rounded-2xl p-5 sm:p-6 text-slate-900 shadow-xl border border-slate-200 mt-6">
                    <form method="GET" action="{{ route('cars.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
                            <!-- Location -->
                            <div>
                                <label class="label text-slate-700">📍 Lokasi Penjemputan</label>
                                <select name="location" class="input text-xs sm:text-sm bg-slate-50">
                                    <option value="Semarang">Semarang (Kota & Bandara)</option>
                                    <option value="Jakarta">Jakarta & Sekitarnya</option>
                                    <option value="Bandung">Bandung</option>
                                    <option value="Surabaya">Surabaya</option>
                                    <option value="Yogyakarta">Yogyakarta</option>
                                    <option value="Bali">Bali (Denpasar/Kuta)</option>
                                    <option value="Medan">Medan</option>
                                </select>
                            </div>

                            <!-- Start Date -->
                            <div>
                                <label class="label text-slate-700">📅 Tanggal Ambil</label>
                                <input type="date" name="start_date" value="{{ date('Y-m-d') }}" class="input text-xs sm:text-sm bg-slate-50">
                            </div>

                            <!-- Category -->
                            <div>
                                <label class="label text-slate-700">🚗 Kategori Mobil</label>
                                <select name="category" class="input text-xs sm:text-sm bg-slate-50">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $cat)
                                    <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2 border-t border-slate-100">
                            <div class="flex items-center gap-4 text-xs text-slate-500">
                                <span class="flex items-center gap-1.5 font-medium">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Lepas Kunci / Driver
                                </span>
                                <span class="flex items-center gap-1.5 font-medium">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Gratis Asuransi
                                </span>
                            </div>

                            <button type="submit" class="btn btn-primary rounded-xl w-full sm:w-auto px-7 py-3 font-bold text-sm shadow-md">
                                🔍 Cari Mobil Tersedia
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column: Showcase Car Image (Honda Civic) -->
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md lg:max-w-none">
                    <!-- Main Showcase Image -->
                    <div class="rounded-3xl overflow-hidden border border-slate-700/80 bg-slate-800/40 p-2 shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1605756580041-21312e9fb2bc?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                             alt="Honda Civic Turbo Sedan Rental" 
                             class="w-full h-80 sm:h-96 object-cover rounded-2xl">
                    </div>

                    <!-- Floating Micro Badge 1: Rating -->
                    <div class="absolute -top-4 -left-4 bg-white rounded-2xl p-3.5 shadow-xl border border-slate-200 text-slate-900 hidden sm:flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center font-bold text-lg">
                            ⭐
                        </div>
                        <div>
                            <p class="font-extrabold text-sm leading-tight">4.9 / 5.0</p>
                            <p class="text-[11px] text-slate-500 font-medium">5+ Pelanggan Puas</p>
                        </div>
                    </div>

                    <!-- Floating Micro Badge 2: Verified Service -->
                    <div class="absolute -bottom-4 -right-4 bg-white rounded-2xl p-3.5 shadow-xl border border-slate-200 text-slate-900 hidden sm:flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <div>
                            <p class="font-extrabold text-sm leading-tight">Armada Nyaman & Bersih</p>
                            <p class="text-[11px] text-emerald-600 font-semibold">100% Bebas Asap Rokok</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- 2. TRUST & STATS BAR -->
<section class="bg-white border-b border-slate-200/80 py-8">
    <div class="container-custom">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="p-3">
                <p class="text-3xl sm:text-4xl font-extrabold text-blue-600">{{ $stats['cars_count'] ?? 15 }}+</p>
                <p class="text-xs sm:text-sm font-semibold text-slate-600 mt-1">Armada Siap Pakai</p>
            </div>
            <div class="p-3">
                <p class="text-3xl sm:text-4xl font-extrabold text-slate-900">{{ $stats['cities_count'] ?? 25 }}+</p>
                <p class="text-xs sm:text-sm font-semibold text-slate-600 mt-1">Kota di Seluruh Indonesia</p>
            </div>
            <div class="p-3">
                <p class="text-3xl sm:text-4xl font-extrabold text-emerald-600">99.8%</p>
                <p class="text-xs sm:text-sm font-semibold text-slate-600 mt-1">Tingkat Kepuasan</p>
            </div>
            <div class="p-3">
                <p class="text-3xl sm:text-4xl font-extrabold text-slate-900">24/7</p>
                <p class="text-xs sm:text-sm font-semibold text-slate-600 mt-1">Layanan Bantuan Siaga</p>
            </div>
        </div>
    </div>
</section>


<!-- 3. FEATURED FLEET (ARMADA UNGGULAN WITH INTERACTIVE CATEGORY TABS) -->
<section class="py-20 lg:py-28 bg-slate-50" id="armada">
    <div class="container-custom">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div>
                <span class="badge-primary mb-3">Pilihan Terbaik</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Armada Mobil Unggulan</h2>
                <p class="text-slate-500 text-sm sm:text-base mt-1.5">Koleksi mobil terawat, wangi, dan siap meluncur menemani agenda Anda.</p>
            </div>

            <a href="{{ route('cars.index') }}" class="btn-outline btn-sm self-start md:self-auto flex items-center gap-2">
                Lihat Semua ({{ $stats['cars_count'] ?? 15 }} Mobil) &rarr;
            </a>
        </div>

        <!-- Interactive Category Tabs -->
        <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-8 no-scrollbar" id="category-tabs">
            <button onclick="filterCategory('all', this)" class="category-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all bg-blue-600 text-white shadow-sm">
                Semua Kategori
            </button>
            @foreach($categories as $cat)
            <button onclick="filterCategory('{{ $cat->slug }}', this)" class="category-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all bg-white text-slate-600 hover:bg-slate-100 border border-slate-200">
                {{ $cat->name }}
            </button>
            @endforeach
        </div>

        <!-- Car Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="cars-grid">
            @forelse($featuredCars as $car)
            <div class="car-card bg-white rounded-2xl border border-slate-200 shadow-xs hover:border-slate-300 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col overflow-hidden group"
                 data-category="{{ $car->category->slug ?? 'all' }}">
                
                <!-- Image Container -->
                <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                    <img src="{{ $car->image }}" 
                         alt="{{ $car->name }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         loading="lazy"
                         onerror="this.src='https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=800'">
                    
                    <!-- Category Badge -->
                    <span class="absolute top-3 left-3 inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-white/95 text-slate-800 backdrop-blur-md shadow-sm border border-slate-200/50">
                        {{ $car->category->name ?? 'Mobil' }}
                    </span>

                    <!-- Availability Status -->
                    @if($car->is_available)
                        <span class="absolute top-3 right-3 inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-500 text-white shadow-md shadow-emerald-500/25">
                            <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                            Tersedia
                        </span>
                    @else
                        <span class="absolute top-3 right-3 inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-slate-800/90 text-slate-200 backdrop-blur-sm shadow-md">
                            Sedang Disewa
                        </span>
                    @endif
                </div>

                <!-- Content Body -->
                <div class="p-5 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-2 mb-1">
                            <h3 class="font-bold text-slate-900 text-base group-hover:text-blue-600 transition-colors truncate">
                                {{ $car->name }}
                            </h3>
                        </div>
                        <p class="text-xs text-slate-400 mb-3.5">{{ $car->brand }} {{ $car->model }} &middot; Thn {{ $car->year }}</p>

                        <!-- Key Specs Pills -->
                        <div class="grid grid-cols-3 gap-1.5 py-2.5 px-3 bg-slate-50 rounded-xl mb-4 text-[11px] text-slate-600 font-medium text-center">
                            <div title="Kapasitas Penumpang">👥 {{ $car->seats }} Kursi</div>
                            <div title="Transmisi">⚙️ {{ $car->transmission === 'automatic' ? 'Matic' : 'Manual' }}</div>
                            <div title="Jenis Bahan Bakar">⛽ {{ ucfirst($car->fuel_type) }}</div>
                        </div>
                    </div>

                    <!-- Price & CTA -->
                    <div class="pt-4 border-t border-slate-100 flex items-end justify-between gap-2">
                        <div class="min-w-0 flex-1">
                            <span class="text-[11px] font-medium text-slate-400 block leading-none mb-1.5">Harga Sewa</span>
                            <div class="flex items-baseline gap-1 whitespace-nowrap overflow-hidden text-ellipsis">
                                <span class="text-lg sm:text-xl font-extrabold text-blue-600 tracking-tight">Rp&nbsp;{{ number_format($car->price_per_day, 0, ',', '.') }}</span>
                                <span class="text-xs text-slate-400 font-normal">/hari</span>
                            </div>
                        </div>

                        <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary btn-sm rounded-xl px-4 py-2 text-xs font-bold shrink-0">
                            Detail & Sewa
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-16 text-center text-slate-400">
                Belum ada data mobil yang aktif.
            </div>
            @endforelse
        </div>
    </div>
</section>


<!-- 4. SERVICES SECTION (LAYANAN KAMI) -->
<section class="py-20 bg-white border-y border-slate-200/80" id="layanan">
    <div class="container-custom">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="badge-primary mb-3">Layanan Fleksibel</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Solusi Rental Sesuai Kebutuhan</h2>
            <p class="text-slate-500 text-sm sm:text-base mt-2">Pilih paket layanan rental mobil yang paling pas dengan rencana perjalanan Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Service 1 -->
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 hover:bg-white hover:shadow-xl hover:border-slate-300 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xl mb-5 shadow-xs">
                    🔑
                </div>
                <h3 class="font-bold text-slate-900 text-base mb-2">Lepas Kunci (Self Drive)</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Nikmati privasi dan kebebasan berkendara sendiri bersama keluarga dengan proses verifikasi dokumen cepat dan mudah.
                </p>
            </div>

            <!-- Service 2 -->
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 hover:bg-white hover:shadow-xl hover:border-slate-300 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xl mb-5 shadow-xs">
                    👔
                </div>
                <h3 class="font-bold text-slate-900 text-base mb-2">Dengan Supir Profesional</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Duduk tenang dan nikmati perjalanan Anda. Driver kami ramah, berlisensi, tepat waktu, dan menguasai rute terbaik.
                </p>
            </div>

            <!-- Service 3 -->
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 hover:bg-white hover:shadow-xl hover:border-slate-300 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center font-bold text-xl mb-5 shadow-xs">
                    🏢
                </div>
                <h3 class="font-bold text-slate-900 text-base mb-2">Rental Korporat & Bulanan</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Solusi armada operasional jangka panjang untuk instansi dan perusahaan dengan tarif khusus dan pemeliharaan berkala terjamin.
                </p>
            </div>

            <!-- Service 4 -->
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 hover:bg-white hover:shadow-xl hover:border-slate-300 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-xl mb-5 shadow-xs">
                    ✈️
                </div>
                <h3 class="font-bold text-slate-900 text-base mb-2">Antar Jemput Bandara & Hotel</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Layanan pick-up & drop-off tepat waktu di bandara internasional, stasiun, hotel, atau langsung ke depan pintu rumah Anda.
                </p>
            </div>
        </div>
    </div>
</section>


<!-- 5. WHY CHOOSE US (KEUNGGULAN KAMI) -->
<section class="py-20 lg:py-28 bg-slate-50">
    <div class="container-custom">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="badge-primary mb-3">Keunggulan Kami</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Mengapa Memilih RentalMobilku?</h2>
            <p class="text-slate-500 text-sm sm:text-base mt-2">Standar pelayanan bintang lima untuk kenyamanan dan ketenangan perjalanan Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($features as $feature)
            <div class="p-6 rounded-2xl border border-slate-200 bg-white shadow-xs hover:shadow-lg transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-5">
                    @if($feature['icon'] === 'shield-check')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    @elseif($feature['icon'] === 'clock')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    @elseif($feature['icon'] === 'map-pin')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    @else
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    @endif
                </div>
                <h3 class="font-bold text-slate-900 text-base mb-1.5">{{ $feature['title'] }}</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">{{ $feature['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- 6. HOW IT WORKS (CARA KERJA) -->
<section class="py-20 bg-white border-y border-slate-200/80" id="cara-kerja">
    <div class="container-custom">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="badge-primary mb-3">Mudah & Cepat</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">3 Langkah Mudah Sewa Mobil</h2>
            <p class="text-slate-500 text-sm sm:text-base mt-2">Hanya butuh beberapa menit dari memilih mobil hingga serah terima kunci.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
            <!-- Step 1 -->
            <div class="p-8 rounded-2xl border border-slate-200 bg-slate-50 text-center relative">
                <div class="w-14 h-14 rounded-2xl bg-blue-600 text-white font-extrabold text-xl flex items-center justify-center mx-auto mb-5 shadow-md shadow-blue-500/25">
                    1
                </div>
                <h3 class="font-bold text-slate-900 text-lg mb-2">Pilih Mobil & Jadwal</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Jelajahi armada kami, pilih tipe mobil yang sesuai dan tentukan tanggal serta lokasi sewa Anda.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="p-8 rounded-2xl border border-slate-200 bg-slate-50 text-center relative">
                <div class="w-14 h-14 rounded-2xl bg-blue-600 text-white font-extrabold text-xl flex items-center justify-center mx-auto mb-5 shadow-md shadow-blue-500/25">
                    2
                </div>
                <h3 class="font-bold text-slate-900 text-lg mb-2">Konfirmasi & Booking</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Isi data diri dengan aman dan selesaikan pembayaran melalui transfer bank, e-wallet, atau kartu.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="p-8 rounded-2xl border border-slate-200 bg-slate-50 text-center relative">
                <div class="w-14 h-14 rounded-2xl bg-emerald-600 text-white font-extrabold text-xl flex items-center justify-center mx-auto mb-5 shadow-md shadow-emerald-500/25">
                    3
                </div>
                <h3 class="font-bold text-slate-900 text-lg mb-2">Mobil Siap Meluncur</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Ambil mobil di titik pool atau tim kami antarkan langsung ke lokasi Anda tepat pada waktunya.
                </p>
            </div>
        </div>
    </div>
</section>


<!-- 7. CUSTOMER TESTIMONIALS -->
<section class="py-20 lg:py-28 bg-slate-50" id="testimoni">
    <div class="container-custom">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="badge-primary mb-3">Ulasan Pengguna</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Apa Kata Pelanggan Kami?</h2>
            <p class="text-slate-500 text-sm sm:text-base mt-2">Pengalaman nyata ribuan penyewa yang telah mempercayakan perjalanannya kepada kami.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($testimonials as $review)
            <div class="bg-white p-6 sm:p-7 rounded-2xl border border-slate-200 shadow-xs flex flex-col justify-between">
                <div>
                    <!-- Star Rating -->
                    <div class="flex items-center gap-1 text-amber-400 mb-4">
                        @for($i = 0; $i < $review->rating; $i++)
                            <span>★</span>
                        @endfor
                    </div>
                    <!-- Comment -->
                    <p class="text-slate-600 text-sm leading-relaxed mb-6 italic">
                        "{{ $review->comment }}"
                    </p>
                </div>

                <!-- User Info -->
                <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                    <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 font-bold text-sm flex items-center justify-center border border-blue-100">
                        {{ substr($review->user->name ?? 'P', 0, 1) }}
                    </div>
                    <div>
                        <p class="font-bold text-slate-900 text-sm">{{ $review->user->name ?? 'Pelanggan Terverifikasi' }}</p>
                        <p class="text-[11px] text-slate-400">Sewa {{ $review->car->name ?? 'Mobil' }} &middot; Terverifikasi</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center text-slate-400">
                Belum ada ulasan yang ditampilkan.
            </div>
            @endforelse
        </div>
    </div>
</section>


<!-- 8. FAQ ACCORDION -->
<section class="py-20 bg-white border-y border-slate-200/80" id="faq">
    <div class="container-custom max-w-3xl">
        <div class="text-center mb-14">
            <span class="badge-primary mb-3">FAQ</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Pertanyaan yang Sering Diajukan</h2>
            <p class="text-slate-500 text-sm sm:text-base mt-2">Temukan jawaban seputar syarat sewa, pembayaran, dan asuransi.</p>
        </div>

        <div class="space-y-3.5">
            @foreach($faqs as $index => $faq)
            <div class="border border-slate-200 rounded-2xl overflow-hidden transition-colors">
                <button onclick="toggleFaq({{ $index }})" class="w-full flex items-center justify-between p-5 text-left bg-slate-50/50 hover:bg-slate-50 transition-colors">
                    <span class="font-bold text-slate-900 text-sm sm:text-base pr-4">{{ $faq['question'] }}</span>
                    <span id="faq-icon-{{ $index }}" class="text-slate-400 font-bold text-lg transition-transform duration-200 flex-shrink-0">+</span>
                </button>
                <div id="faq-body-{{ $index }}" class="hidden p-5 pt-0 bg-slate-50/50 border-t border-slate-100 text-xs sm:text-sm text-slate-600 leading-relaxed">
                    {{ $faq['answer'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- 9. CTA BANNER -->
<section class="py-16 bg-slate-900 text-white relative overflow-hidden border-t border-slate-800">
    <div class="container-custom relative z-10 text-center max-w-2xl mx-auto">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-slate-800 border border-slate-700 text-blue-400 text-xs font-semibold mb-4">
            ✨ Mulai Perjalanan Liburan Anda
        </span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-3 leading-tight">
            Siap Menjelajahi Kota dengan Nyaman?
        </h2>
        <p class="text-slate-300 text-sm sm:text-base mb-8 leading-relaxed">
            Pesan armada mobil keluarga Anda sekarang dan nikmati penawaran spesial serta kemudahan booking tanpa ribet.
        </p>
        <div class="flex flex-wrap justify-center gap-3.5">
            <a href="{{ route('cars.index') }}" class="btn btn-primary rounded-xl px-7 py-3 font-bold text-sm shadow-md">
                Pilih Mobil Sekarang
            </a>
            <a href="https://wa.me/6281299779053" target="_blank" class="btn btn-outline-white rounded-xl px-6 py-3 font-bold text-sm">
                💬 Chat WhatsApp CS 24 Jam
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
// Category Filter
function filterCategory(category, buttonElement) {
    const buttons = document.querySelectorAll('.category-tab-btn');
    buttons.forEach(btn => {
        btn.classList.remove('bg-blue-600', 'text-white', 'shadow-sm');
        btn.classList.add('bg-white', 'text-slate-600', 'hover:bg-slate-100', 'border', 'border-slate-200');
    });

    buttonElement.classList.remove('bg-white', 'text-slate-600', 'hover:bg-slate-100', 'border', 'border-slate-200');
    buttonElement.classList.add('bg-blue-600', 'text-white', 'shadow-sm');

    const carCards = document.querySelectorAll('.car-card');
    carCards.forEach(card => {
        if (category === 'all' || card.getAttribute('data-category') === category) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

// FAQ Accordion
function toggleFaq(index) {
    const body = document.getElementById('faq-body-' + index);
    const icon = document.getElementById('faq-icon-' + index);
    
    if (body.classList.contains('hidden')) {
        body.classList.remove('hidden');
        icon.innerText = '−';
        icon.classList.add('text-blue-600');
    } else {
        body.classList.add('hidden');
        icon.innerText = '+';
        icon.classList.remove('text-blue-600');
    }
}
</script>
@endpush
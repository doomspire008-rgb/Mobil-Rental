@extends('layouts.app')

@section('title', 'Katalog Armada Mobil - RentalMobilku')

@section('content')
<!-- Header Banner -->
<section class="relative bg-slate-950 text-white pt-32 pb-16 overflow-hidden">
    <div class="hero-glow w-96 h-96 bg-blue-600/15 top-0 right-10"></div>
    <div class="container-custom relative z-10">
        <span class="badge-neutral bg-slate-900 border-slate-800 text-blue-400 mb-3 inline-block">Katalog Lengkap</span>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight">Pilihan Armada Rental</h1>
        <p class="text-slate-400 text-sm sm:text-base mt-2 max-w-xl">Temukan kendaraan yang tepat untuk liburan, perjalanan dinas, atau kebutuhan sehari-hari.</p>
    </div>
</section>

<!-- Main Filter & Grid -->
<section class="py-12 bg-slate-50">
    <div class="container-custom">
        <div class="grid lg:grid-cols-4 gap-8">
            <!-- Sidebar Filter -->
            <aside class="lg:col-span-1">
                <form method="GET" action="{{ route('cars.index') }}" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs space-y-4 sticky top-24">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <h2 class="font-bold text-slate-900 text-sm">Filter Armada</h2>
                        <a href="{{ route('cars.index') }}" class="text-xs text-blue-600 hover:text-blue-700 font-semibold">Reset</a>
                    </div>

                    <div>
                        <label class="label">Pencarian</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama, merk, model..." class="input text-xs">
                    </div>

                    <div>
                        <label class="label">Kategori</label>
                        <select name="category" class="input text-xs">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>{{ $cat->name }} ({{ $cat->cars_count }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="label">Transmisi</label>
                        <select name="transmission" class="input text-xs">
                            <option value="">Semua Transmisi</option>
                            <option value="automatic" {{ request('transmission') === 'automatic' ? 'selected' : '' }}>Automatic</option>
                            <option value="manual" {{ request('transmission') === 'manual' ? 'selected' : '' }}>Manual</option>
                        </select>
                    </div>

                    <div>
                        <label class="label">Bahan Bakar</label>
                        <select name="fuel_type" class="input text-xs">
                            <option value="">Semua Bahan Bakar</option>
                            <option value="bensin" {{ request('fuel_type') === 'bensin' ? 'selected' : '' }}>Bensin</option>
                            <option value="diesel" {{ request('fuel_type') === 'diesel' ? 'selected' : '' }}>Diesel</option>
                            <option value="electric" {{ request('fuel_type') === 'electric' ? 'selected' : '' }}>Electric</option>
                            <option value="hybrid" {{ request('fuel_type') === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>

                    <div>
                        <label class="label">Rentang Harga / Hari</label>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min (Rp)" class="input text-xs">
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max (Rp)" class="input text-xs">
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-full py-2.5 text-xs">
                        Terapkan Filter
                    </button>
                </form>
            </aside>

            <!-- Cars Listing -->
            <div class="lg:col-span-3">
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($cars as $car)
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs hover:shadow-xl hover:border-slate-300 hover:-translate-y-1 transition-all duration-300 flex flex-col overflow-hidden group">
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                            <img src="{{ $car->image }}" alt="{{ $car->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                            <span class="absolute top-3 left-3 inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-white/95 text-slate-800 backdrop-blur-md shadow-sm border border-slate-200/50">
                                {{ $car->category->name ?? 'Mobil' }}
                            </span>
                            @if($car->is_available)
                                <span class="absolute top-3 right-3 inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-500 text-white shadow-md shadow-emerald-500/25">
                                    <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                    Tersedia
                                </span>
                            @else
                                <span class="absolute top-3 right-3 inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-slate-800/90 text-slate-200 backdrop-blur-sm shadow-md">
                                    Disewa
                                </span>
                            @endif
                        </div>

                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-slate-900 text-base group-hover:text-blue-600 transition-colors truncate">
                                    {{ $car->name }}
                                </h3>
                                <p class="text-xs text-slate-400 mb-3">{{ $car->brand }} {{ $car->model }} &middot; {{ $car->year }}</p>
                                
                                <div class="grid grid-cols-3 gap-1 py-2 px-2.5 bg-slate-50 rounded-xl mb-4 text-[11px] text-slate-600 font-medium text-center">
                                    <div>👥 {{ $car->seats }} Kursi</div>
                                    <div>⚙️ {{ $car->transmission === 'automatic' ? 'Matic' : 'Manual' }}</div>
                                    <div>⛽ {{ ucfirst($car->fuel_type) }}</div>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-slate-100 flex items-end justify-between gap-2">
                                <div class="min-w-0 flex-1">
                                    <span class="text-[11px] font-medium text-slate-400 block leading-none mb-1.5">Harga Sewa</span>
                                    <div class="flex items-baseline gap-1 whitespace-nowrap overflow-hidden text-ellipsis">
                                        <span class="text-base sm:text-lg font-extrabold text-blue-600 tracking-tight">Rp&nbsp;{{ number_format($car->price_per_day, 0, ',', '.') }}</span>
                                        <span class="text-xs text-slate-400 font-normal">/hari</span>
                                    </div>
                                </div>
                                <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary btn-sm rounded-xl px-3.5 py-2 text-xs font-bold shrink-0">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full bg-white rounded-2xl border border-slate-200 p-12 text-center">
                        <p class="text-slate-600 font-bold text-base mb-1">Tidak ada mobil yang sesuai filter</p>
                        <p class="text-slate-400 text-xs mb-4">Coba ubah kata kunci pencarian atau reset filter Anda.</p>
                        <a href="{{ route('cars.index') }}" class="btn-secondary btn-sm">Reset Filter</a>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $cars->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
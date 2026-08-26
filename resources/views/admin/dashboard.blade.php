@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('header', 'Dashboard Overview')

@section('content')
<div class="space-y-8">
    <!-- KPI Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Total Cars -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Armada</span>
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 5h8m-8 5h8M4 5a2 2 0 012-2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5z"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-slate-900">{{ $stats['total_cars'] }}</span>
                <span class="text-xs text-emerald-600 font-semibold">{{ $stats['available_cars'] }} Siap Sewa</span>
            </div>
            <p class="text-xs text-slate-400 mt-2">{{ $stats['rented_cars'] }} mobil sedang beroperasi</p>
        </div>

        <!-- Active Bookings -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Booking Aktif</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-slate-900">{{ $stats['active_bookings'] }}</span>
                <span class="text-xs text-amber-600 font-semibold">{{ $stats['pending_bookings'] }} Menunggu</span>
            </div>
            <p class="text-xs text-slate-400 mt-2">Dari total {{ $stats['total_bookings'] }} booking</p>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Pendapatan</span>
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="text-2xl font-extrabold text-slate-900 truncate">
                Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
            </div>
            <p class="text-xs text-slate-400 mt-2">Dari transaksi terkonfirmasi</p>
        </div>

        <!-- Total Customers -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Pelanggan</span>
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-slate-900">{{ $stats['total_customers'] }}</span>
                <span class="text-xs text-slate-500">Terdaftar</span>
            </div>
            <p class="text-xs text-slate-400 mt-2">Member aktif platform</p>
        </div>
    </div>

    <!-- Main Grid: Recent Bookings & Fleet Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Bookings Table (2 Cols) -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-bold text-slate-900">Transaksi Booking Terbaru</h2>
                    <p class="text-xs text-slate-500">Daftar reservasi masuk dan status aktif</p>
                </div>
                <a href="{{ route('admin.bookings.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                        <tr>
                            <th class="py-3.5 px-6">Pelanggan & Mobil</th>
                            <th class="py-3.5 px-6">Jadwal Sewa</th>
                            <th class="py-3.5 px-6">Total</th>
                            <th class="py-3.5 px-6">Status</th>
                            <th class="py-3.5 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($recentBookings as $booking)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-4 px-6">
                                <p class="font-semibold text-slate-900">{{ $booking->user->name ?? 'Guest' }}</p>
                                <p class="text-xs text-slate-500">{{ $booking->car->name ?? 'Mobil dihapus' }} ({{ $booking->car->plate_number ?? '-' }})</p>
                            </td>
                            <td class="py-4 px-6 text-xs text-slate-600">
                                <span class="font-medium text-slate-800">{{ $booking->start_date->format('d M') }} - {{ $booking->end_date->format('d M Y') }}</span>
                                <span class="block text-slate-400 mt-0.5">{{ $booking->pickup_location ?? 'Ambil di Pool' }}</span>
                            </td>
                            <td class="py-4 px-6 font-semibold text-slate-900">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-6">
                                @if($booking->status === 'completed')
                                    <span class="badge-success">Selesai</span>
                                @elseif($booking->status === 'active')
                                    <span class="badge-primary">Sedang Aktif</span>
                                @elseif($booking->status === 'pending')
                                    <span class="badge-warning">Menunggu</span>
                                @elseif($booking->status === 'cancelled')
                                    <span class="badge-danger">Dibatalkan</span>
                                @else
                                    <span class="badge-neutral">{{ ucfirst($booking->status) }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="inline-flex items-center gap-1">
                                    @if($booking->status === 'pending')
                                        <form method="POST" action="{{ route('admin.bookings.status', $booking->id) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="active">
                                            <button type="submit" class="p-1.5 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 text-xs font-semibold" title="Konfirmasi & Aktifkan">
                                                Setujui
                                            </button>
                                        </form>
                                    @elseif($booking->status === 'active')
                                        <form method="POST" action="{{ route('admin.bookings.status', $booking->id) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="p-1.5 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 text-xs font-semibold" title="Selesaikan">
                                                Selesai
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400 text-sm">
                                Belum ada riwayat booking transaksi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top Fleet Column (1 Col) -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xs">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-base font-bold text-slate-900">Armada Paling Diminati</h2>
                    <a href="{{ route('admin.cars.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700">Kelola</a>
                </div>
                <div class="space-y-4">
                    @foreach($featuredCars as $car)
                    <div class="flex items-center gap-3 pb-3 border-b border-slate-100 last:border-0 last:pb-0">
                        <img src="{{ $car->image }}" alt="{{ $car->name }}" class="w-14 h-11 rounded-lg object-cover flex-shrink-0 border border-slate-200">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-900 truncate">{{ $car->name }}</p>
                            <p class="text-xs text-slate-400">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}/hari</p>
                        </div>
                        <div class="text-right">
                            <span class="badge-neutral text-[11px]">{{ $car->bookings_count }}x Sewa</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Quick Action Box -->
            <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-2xl p-6 text-white shadow-lg">
                <h3 class="font-bold text-base mb-1">Aksi Cepat Admin</h3>
                <p class="text-xs text-slate-300 mb-4">Kelola operasional rental mobil harian dengan mudah.</p>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('admin.cars.index') }}" class="btn btn-primary btn-sm rounded-xl justify-center text-center">
                        + Tambah Mobil
                    </a>
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-white btn-sm rounded-xl justify-center text-center">
                        Semua Booking
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

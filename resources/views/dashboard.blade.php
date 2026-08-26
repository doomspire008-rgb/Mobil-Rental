@extends('layouts.app')

@section('title', 'Dashboard Pelanggan - RentalMobilku')

@section('content')
<!-- Header Banner -->
<section class="bg-slate-950 text-white pt-28 pb-12">
    <div class="container-custom flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="badge-neutral bg-slate-900 border-slate-800 text-blue-400 mb-2 inline-block">Akun Pelanggan</span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white">Halo, {{ auth()->user()->name }} 👋</h1>
            <p class="text-slate-400 text-xs sm:text-sm mt-0.5">{{ auth()->user()->email }} &middot; {{ auth()->user()->phone ?? 'Belum ada nomor HP' }}</p>
        </div>
        <div>
            <a href="{{ route('cars.index') }}" class="btn-primary btn-sm">
                + Sewa Mobil Baru
            </a>
        </div>
    </div>
</section>

<!-- Dashboard Body -->
<section class="py-12 bg-slate-50">
    <div class="container-custom space-y-8">
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xl">
                    🚗
                </div>
                <div>
                    <p class="text-2xl font-extrabold text-slate-900">{{ auth()->user()->bookings->count() }}</p>
                    <p class="text-xs text-slate-500 font-medium">Total Riwayat Sewa</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xl">
                    ⚡
                </div>
                <div>
                    <p class="text-2xl font-extrabold text-slate-900">{{ auth()->user()->bookings->where('status', 'active')->count() }}</p>
                    <p class="text-xs text-slate-500 font-medium">Sewa Sedang Aktif</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center font-bold text-xl">
                    ✓
                </div>
                <div>
                    <p class="text-2xl font-extrabold text-slate-900">{{ auth()->user()->bookings->where('status', 'completed')->count() }}</p>
                    <p class="text-xs text-slate-500 font-medium">Sewa Selesai</p>
                </div>
            </div>
        </div>

        <!-- Booking History Table -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-base font-bold text-slate-900">Riwayat Reservasi & Booking</h2>
                <span class="text-xs text-slate-500">{{ auth()->user()->bookings->count() }} Transaksi</span>
            </div>

            @if(auth()->user()->bookings->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                        <tr>
                            <th class="py-3.5 px-6">Mobil Disewa</th>
                            <th class="py-3.5 px-6">Jadwal Sewa</th>
                            <th class="py-3.5 px-6">Total Biaya</th>
                            <th class="py-3.5 px-6">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach(auth()->user()->bookings as $booking)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-4 px-6">
                                <p class="font-bold text-slate-900">{{ $booking->car->name ?? 'Mobil' }}</p>
                                <p class="text-xs text-slate-400 font-mono">{{ $booking->car->plate_number ?? '-' }}</p>
                            </td>
                            <td class="py-4 px-6 text-xs text-slate-600">
                                <span class="font-semibold text-slate-800">{{ $booking->start_date->format('d M') }} - {{ $booking->end_date->format('d M Y') }}</span>
                                <span class="block text-slate-400 mt-0.5">{{ $booking->pickup_location ?? 'Ambil di pool' }}</span>
                            </td>
                            <td class="py-4 px-6 font-bold text-slate-900">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-6">
                                @if($booking->status === 'completed')
                                    <span class="badge-success">Selesai</span>
                                @elseif($booking->status === 'active')
                                    <span class="badge-primary">Sedang Aktif</span>
                                @elseif($booking->status === 'pending')
                                    <span class="badge-warning">Menunggu Konfirmasi</span>
                                @elseif($booking->status === 'cancelled')
                                    <span class="badge-danger">Dibatalkan</span>
                                @else
                                    <span class="badge-neutral">{{ ucfirst($booking->status) }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="p-12 text-center">
                <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-4 text-2xl">
                    🚗
                </div>
                <p class="font-bold text-slate-900 text-base mb-1">Belum Ada Riwayat Sewa Mobil</p>
                <p class="text-slate-400 text-xs mb-6 max-w-sm mx-auto">Pilih armada favorit Anda sekarang dan nikmati diskon khusus perjalanan pertama.</p>
                <a href="{{ route('cars.index') }}" class="btn-primary btn-sm">Mulai Sewa Mobil</a>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
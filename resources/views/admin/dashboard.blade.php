@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
    @php
        $cards = [
            ['label' => 'Total Mobil', 'value' => number_format($stats['cars_count']), 'sub' => $stats['cars_available'] . ' tersedia', 'gradient' => 'gradient-forest', 'icon' => 'M8 17h8m-8 0a2 2 0 100 4 2 2 0 000-4zm8 0a2 2 0 100 4 2 2 0 000-4zM3 7h13l3 5v5h-2M3 7v9h2M3 7l1.5-3h9L16 7'],
            ['label' => 'Booking Pending', 'value' => number_format($stats['bookings_pending']), 'sub' => 'menunggu konfirmasi', 'gradient' => 'gradient-secondary', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['label' => 'Booking Aktif', 'value' => number_format($stats['bookings_active']), 'sub' => 'sedang berjalan', 'gradient' => 'gradient-ocean', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['label' => 'Total Pelanggan', 'value' => number_format($stats['customers_count']), 'sub' => 'akun customer', 'gradient' => 'gradient-royal', 'icon' => 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-5.13a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 11-8 0 4 4 0 018 0z'],
            ['label' => 'Pendapatan', 'value' => 'Rp ' . number_format($stats['revenue'], 0, ',', '.'), 'sub' => 'dari booking selesai', 'gradient' => 'gradient-accent', 'icon' => 'M12 8c-1.657 0-3 .672-3 1.5S10.343 11 12 11s3 .672 3 1.5-1.343 1.5-3 1.5m0-6V6m0 1.5V6m0 12v-1.5m0 0c-1.657 0-3-.672-3-1.5m3 1.5c1.657 0 3-.672 3-1.5'],
        ];
    @endphp
    @foreach($cards as $card)
    <div class="bg-white rounded-2xl border border-neutral-100 p-6 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 {{ $card['gradient'] }} shadow-medium">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['icon'] }}"/></svg>
        </div>
        <div class="min-w-0">
            <p class="text-2xl font-bold text-neutral-900 truncate">{{ $card['value'] }}</p>
            <p class="text-sm text-neutral-500">{{ $card['label'] }}</p>
            <p class="text-xs text-neutral-400">{{ $card['sub'] }}</p>
        </div>
    </div>
    @endforeach

    <a href="{{ route('admin.cars.create') }}" class="rounded-2xl border-2 border-dashed border-primary-300 p-6 flex flex-col items-center justify-center text-center hover:border-primary-500 hover:bg-primary-50 transition-colors group">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-2 gradient-primary shadow-medium group-hover:scale-105 transition-transform">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        </div>
        <p class="text-sm font-medium text-primary-700">Tambah Mobil Baru</p>
    </a>
</div>

<div class="bg-white rounded-2xl border border-neutral-100 overflow-hidden">
    <div class="flex items-center justify-between p-6 border-b border-neutral-100">
        <h2 class="font-semibold text-neutral-900">Booking Terbaru</h2>
        <a href="{{ route('admin.bookings.index') }}" class="text-sm font-medium text-primary-600 hover:text-primary-700">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-neutral-400 border-b border-neutral-100">
                    <th class="px-6 py-3 font-medium">Pelanggan</th>
                    <th class="px-6 py-3 font-medium">Mobil</th>
                    <th class="px-6 py-3 font-medium">Tanggal</th>
                    <th class="px-6 py-3 font-medium">Total</th>
                    <th class="px-6 py-3 font-medium">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-100">
                @forelse($recentBookings as $booking)
                <tr>
                    <td class="px-6 py-4 text-neutral-700">{{ $booking->user->name ?? '-' }}</td>
                    <td class="px-6 py-4 text-neutral-700">{{ $booking->car->name ?? '-' }}</td>
                    <td class="px-6 py-4 text-neutral-500">{{ optional($booking->start_date)->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-neutral-700 font-medium">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <span class="badge {{ match($booking->status) {
                            'completed', 'active', 'confirmed' => 'badge-success',
                            'pending', 'processing' => 'badge-warning',
                            default => 'badge-danger',
                        } }}">{{ ucfirst($booking->status) }}</span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-10 text-center text-neutral-400">Belum ada booking.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

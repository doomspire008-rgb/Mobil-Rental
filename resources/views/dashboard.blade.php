@extends('layouts.app')

@section('title', 'Dashboard - RentalMobilku')

@section('content')
<div class="pt-24 pb-8" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
    <div class="container-custom">
        <h1 class="text-3xl font-bold text-white mb-2">Dashboard</h1>
        <p class="text-slate-400">Selamat datang, {{ auth()->user()->name }}</p>
    </div>
</div>

<section class="section">
    <div class="container-custom">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-neutral-100">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #dcfce7, #bbf7d0);">
                        <svg class="w-6 h-6" style="color: #16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-neutral-900">{{ auth()->user()->bookings->count() }}</p>
                        <p class="text-sm text-neutral-500">Total Booking</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-neutral-100">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #fef9c3, #fef08a);">
                        <svg class="w-6 h-6" style="color: #ca8a04;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-neutral-900">{{ auth()->user()->bookings->where('status', 'active')->count() }}</p>
                        <p class="text-sm text-neutral-500">Booking Aktif</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-neutral-100">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #dbeafe, #bfdbfe);">
                        <svg class="w-6 h-6" style="color: #2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-neutral-900">{{ auth()->user()->bookings->where('status', 'completed')->count() }}</p>
                        <p class="text-sm text-neutral-500">Selesai</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 bg-white rounded-2xl border border-neutral-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-neutral-900">Riwayat Booking</h2>
                <a href="{{ route('cars.index') }}" class="btn-primary btn-sm">Booking Baru</a>
            </div>
            @if(auth()->user()->bookings->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-neutral-100">
                            <th class="text-left py-3 px-4 font-medium text-neutral-500">Mobil</th>
                            <th class="text-left py-3 px-4 font-medium text-neutral-500">Tanggal</th>
                            <th class="text-left py-3 px-4 font-medium text-neutral-500">Total</th>
                            <th class="text-left py-3 px-4 font-medium text-neutral-500">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(auth()->user()->bookings->take(10) as $booking)
                        <tr class="border-b border-neutral-50 hover:bg-neutral-50">
                            <td class="py-3 px-4">
                                <p class="font-medium text-neutral-900">{{ $booking->car->name ?? '-' }}</p>
                                <p class="text-xs text-neutral-400">{{ $booking->car->brand ?? '' }} {{ $booking->car->model ?? '' }}</p>
                            </td>
                            <td class="py-3 px-4 text-neutral-600">{{ $booking->start_date->format('d M') }} - {{ $booking->end_date->format('d M Y') }}</td>
                            <td class="py-3 px-4 font-medium text-neutral-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td class="py-3 px-4">
                                @if($booking->status === 'completed')
                                <span class="badge-success">Selesai</span>
                                @elseif($booking->status === 'active')
                                <span class="badge-primary">Aktif</span>
                                @elseif($booking->status === 'pending')
                                <span class="badge-warning">Menunggu</span>
                                @elseif($booking->status === 'cancelled')
                                <span class="badge-danger">Dibatalkan</span>
                                @else
                                <span class="badge">{{ $booking->status }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 mx-auto text-neutral-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <p class="text-neutral-400 mb-4">Belum ada booking</p>
                <a href="{{ route('cars.index') }}" class="btn-primary">Mulai Sewa Mobil</a>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
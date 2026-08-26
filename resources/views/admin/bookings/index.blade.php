@extends('layouts.admin')

@section('title', 'Data Booking')
@section('header', 'Manajemen Transaksi Booking')

@section('content')
<div class="space-y-6">
    <!-- Filters -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs flex flex-col md:flex-row items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="flex flex-wrap items-center gap-3 w-full">
            <div class="relative min-w-[240px]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pelanggan / mobil / plat..." class="input pr-8 text-sm">
                <svg class="w-4 h-4 text-slate-400 absolute right-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            <select name="status" class="input w-auto text-sm" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif (Sedang Sewa)</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>

            <button type="submit" class="btn btn-secondary btn-sm rounded-xl">Filter</button>
            @if(request()->hasAny(['search', 'status']))
                <a href="{{ route('admin.bookings.index') }}" class="text-xs text-slate-500 hover:text-slate-800">Reset</a>
            @endif
        </form>
    </div>

    <!-- Bookings Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                    <tr>
                        <th class="py-3.5 px-6">ID & Pelanggan</th>
                        <th class="py-3.5 px-6">Mobil Yang Disewa</th>
                        <th class="py-3.5 px-6">Jadwal & Lokasi</th>
                        <th class="py-3.5 px-6">Total Biaya</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6 text-right">Ubah Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-4 px-6">
                            <span class="text-xs font-mono font-bold text-blue-600">#BK-{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</span>
                            <p class="font-bold text-slate-900 mt-0.5">{{ $booking->user->name ?? 'User Terhapus' }}</p>
                            <p class="text-xs text-slate-400">{{ $booking->user->phone ?? '-' }} &middot; {{ $booking->user->email ?? '-' }}</p>
                        </td>
                        <td class="py-4 px-6">
                            <p class="font-semibold text-slate-900">{{ $booking->car->name ?? 'Mobil dihapus' }}</p>
                            <span class="badge-neutral text-[11px] mt-0.5">{{ $booking->car->plate_number ?? '-' }}</span>
                        </td>
                        <td class="py-4 px-6 text-xs text-slate-600">
                            <p class="font-semibold text-slate-800">{{ $booking->start_date->format('d M Y') }} s/d {{ $booking->end_date->format('d M Y') }}</p>
                            <p class="text-slate-400 mt-0.5">{{ $booking->pickup_location ?? 'Ambil di Garasi' }}</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="font-extrabold text-slate-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                            @if($booking->deposit > 0)
                                <p class="text-[11px] text-slate-400">DP: Rp {{ number_format($booking->deposit, 0, ',', '.') }}</p>
                            @endif
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
                            <form method="POST" action="{{ route('admin.bookings.status', $booking->id) }}" class="inline-flex items-center gap-1">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="text-xs bg-slate-50 border border-slate-200 rounded-lg px-2 py-1 font-medium text-slate-700">
                                    <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="active" {{ $booking->status === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-slate-400">
                            Tidak ada transaksi booking yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection

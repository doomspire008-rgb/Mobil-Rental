@extends('layouts.admin')

@section('title', 'Kelola Booking')

@section('content')
<form method="GET" class="flex flex-wrap gap-3 mb-6">
    <select name="status" class="input max-w-[12rem]" onchange="this.form.submit()">
        <option value="">Semua Status</option>
        @foreach(['pending', 'confirmed', 'processing', 'active', 'completed', 'cancelled', 'rejected'] as $status)
        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
        @endforeach
    </select>
    @if(request('status'))
    <a href="{{ route('admin.bookings.index') }}" class="btn-ghost btn-sm">Reset</a>
    @endif
</form>

<div class="bg-white rounded-2xl border border-neutral-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-neutral-400 border-b border-neutral-100">
                    <th class="px-6 py-3 font-medium">ID</th>
                    <th class="px-6 py-3 font-medium">Pelanggan</th>
                    <th class="px-6 py-3 font-medium">Mobil</th>
                    <th class="px-6 py-3 font-medium">Periode</th>
                    <th class="px-6 py-3 font-medium">Total</th>
                    <th class="px-6 py-3 font-medium">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-100">
                @forelse($bookings as $booking)
                <tr class="hover:bg-neutral-50">
                    <td class="px-6 py-4 text-neutral-500">#{{ $booking->id }}</td>
                    <td class="px-6 py-4 text-neutral-700">{{ $booking->user->name ?? '-' }}</td>
                    <td class="px-6 py-4 text-neutral-700">{{ $booking->car->name ?? '-' }}</td>
                    <td class="px-6 py-4 text-neutral-500">{{ optional($booking->start_date)->format('d M') }} - {{ optional($booking->end_date)->format('d M Y') }}</td>
                    <td class="px-6 py-4 font-medium text-neutral-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <form method="POST" action="{{ route('admin.bookings.updateStatus', $booking) }}" class="flex items-center gap-2">
                            @csrf
                            @method('PUT')
                            <select name="status" class="input !py-1.5 !text-xs" onchange="this.form.submit()">
                                @foreach(['pending', 'confirmed', 'processing', 'active', 'completed', 'cancelled', 'rejected'] as $status)
                                <option value="{{ $status }}" {{ $booking->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-6 py-12 text-center text-neutral-400">Belum ada booking.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($bookings->hasPages())
    <div class="p-4 border-t border-neutral-100">
        {{ $bookings->links() }}
    </div>
    @endif
</div>
@endsection

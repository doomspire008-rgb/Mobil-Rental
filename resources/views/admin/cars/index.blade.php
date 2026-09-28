@extends('layouts.admin')

@section('title', 'Kelola Mobil')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <form method="GET" class="flex flex-wrap gap-3 flex-1">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, merk, atau plat nomor..." class="input max-w-xs">
        <select name="category" class="input max-w-[10rem]" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ (string) request('category') === (string) $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-outline btn-sm">Cari</button>
        @if(request()->hasAny(['search', 'category']))
        <a href="{{ route('admin.cars.index') }}" class="btn-ghost btn-sm">Reset</a>
        @endif
    </form>
    <a href="{{ route('admin.cars.create') }}" class="btn-primary flex-shrink-0">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Mobil
    </a>
</div>

<div class="bg-white rounded-2xl border border-neutral-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-neutral-400 border-b border-neutral-100">
                    <th class="px-6 py-3 font-medium">Mobil</th>
                    <th class="px-6 py-3 font-medium">Kategori</th>
                    <th class="px-6 py-3 font-medium">Harga/Hari</th>
                    <th class="px-6 py-3 font-medium">Stok</th>
                    <th class="px-6 py-3 font-medium">Status</th>
                    <th class="px-6 py-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-100">
                @forelse($cars as $car)
                <tr class="hover:bg-neutral-50">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ $car->image }}" alt="{{ $car->name }}" class="w-12 h-12 rounded-lg object-cover bg-neutral-100 flex-shrink-0">
                            <div class="min-w-0">
                                <p class="font-medium text-neutral-900 truncate">{{ $car->name }}</p>
                                <p class="text-xs text-neutral-400">{{ $car->brand }} {{ $car->model }} &middot; {{ $car->plate_number }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-neutral-600">{{ $car->category->name ?? '-' }}</td>
                    <td class="px-6 py-4 font-medium text-neutral-900">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-neutral-600">{{ $car->stock }}</td>
                    <td class="px-6 py-4">
                        <span class="badge {{ $car->status === 'available' ? 'badge-success' : ($car->status === 'maintenance' ? 'badge-warning' : 'badge-danger') }}">
                            {{ ucfirst($car->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.cars.edit', $car) }}" class="p-2 rounded-lg text-neutral-500 hover:text-primary-600 hover:bg-primary-50 transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form method="POST" action="{{ route('admin.cars.destroy', $car) }}" onsubmit="return confirm('Hapus mobil {{ $car->name }}? Tindakan ini tidak dapat dibatalkan.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg text-neutral-500 hover:text-red-600 hover:bg-red-50 transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-6 py-12 text-center text-neutral-400">Belum ada mobil. <a href="{{ route('admin.cars.create') }}" class="text-primary-600 font-medium">Tambah sekarang</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($cars->hasPages())
    <div class="p-4 border-t border-neutral-100">
        {{ $cars->links() }}
    </div>
    @endif
</div>
@endsection

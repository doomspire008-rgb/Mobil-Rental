@extends('layouts.admin')

@section('title', 'Data Pengguna')
@section('header', 'Manajemen Pengguna & Pelanggan')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">Daftar Pengguna Platform</h2>
                <p class="text-xs text-slate-500">Seluruh akun administrator dan pelanggan yang terdaftar</p>
            </div>
            <span class="badge-primary">{{ $users->total() }} Total Pengguna</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                    <tr>
                        <th class="py-3.5 px-6">Pengguna</th>
                        <th class="py-3.5 px-6">Kontak & Alamat</th>
                        <th class="py-3.5 px-6">Role / Peran</th>
                        <th class="py-3.5 px-6">Total Booking</th>
                        <th class="py-3.5 px-6">Bergabung</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($users as $user)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 font-bold flex items-center justify-center border border-slate-200">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-xs text-slate-600">
                            <p class="font-medium text-slate-800">{{ $user->phone ?? 'Belum ada no. HP' }}</p>
                            <p class="text-slate-400 mt-0.5">{{ $user->address ?? 'Indonesia' }}</p>
                        </td>
                        <td class="py-4 px-6">
                            @if($user->role === 'admin')
                                <span class="badge-primary">Administrator</span>
                            @else
                                <span class="badge-neutral">Customer</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <span class="font-bold text-slate-800">{{ $user->bookings_count }}x Transaksi</span>
                        </td>
                        <td class="py-4 px-6 text-xs text-slate-500">
                            {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection

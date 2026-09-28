@extends('layouts.admin')

@section('title', 'Kelola Pengguna')

@section('content')
<form method="GET" class="flex flex-wrap gap-3 mb-6">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." class="input max-w-xs">
    <button type="submit" class="btn-outline btn-sm">Cari</button>
    @if(request('search'))
    <a href="{{ route('admin.users.index') }}" class="btn-ghost btn-sm">Reset</a>
    @endif
</form>

<div class="bg-white rounded-2xl border border-neutral-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-neutral-400 border-b border-neutral-100">
                    <th class="px-6 py-3 font-medium">Nama</th>
                    <th class="px-6 py-3 font-medium">Email</th>
                    <th class="px-6 py-3 font-medium">Telepon</th>
                    <th class="px-6 py-3 font-medium">Booking</th>
                    <th class="px-6 py-3 font-medium">Role</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-100">
                @forelse($users as $user)
                <tr class="hover:bg-neutral-50">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold gradient-primary flex-shrink-0">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <span class="font-medium text-neutral-900">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-neutral-600">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-neutral-500">{{ $user->phone ?? '-' }}</td>
                    <td class="px-6 py-4 text-neutral-500">{{ $user->bookings_count }}</td>
                    <td class="px-6 py-4">
                        <form method="POST" action="{{ route('admin.users.updateRole', $user) }}" class="flex items-center gap-2">
                            @csrf
                            @method('PUT')
                            <select name="role" class="input !py-1.5 !text-xs" onchange="this.form.submit()" {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-12 text-center text-neutral-400">Belum ada pengguna.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="p-4 border-t border-neutral-100">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection

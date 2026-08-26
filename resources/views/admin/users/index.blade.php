@extends('layouts.admin')

@section('title', 'Data Pengguna')
@section('header', 'Manajemen Pengguna & Administrator')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-base font-bold text-slate-900">Daftar Pengguna & Hak Akses</h2>
                <p class="text-xs text-slate-500">Kelola akun administrator dan pelanggan dengan kontrol penuh hak akses</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="badge-primary hidden sm:inline-flex">{{ $users->total() }} Total Pengguna</span>
                <button onclick="document.getElementById('modal-add-user').classList.remove('hidden')" class="btn-primary text-xs flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Akun Baru
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                    <tr>
                        <th class="py-3.5 px-6">Pengguna</th>
                        <th class="py-3.5 px-6">Kontak & Alamat</th>
                        <th class="py-3.5 px-6">Peran / Role</th>
                        <th class="py-3.5 px-6">Total Booking</th>
                        <th class="py-3.5 px-6">Bergabung</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($users as $user)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl {{ $user->role === 'admin' ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'bg-slate-100 text-slate-700 border border-slate-200' }} font-bold flex items-center justify-center">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <p class="font-bold text-slate-900">{{ $user->name }}</p>
                                        @if($user->id === auth()->id())
                                            <span class="text-[10px] bg-emerald-100 text-emerald-700 font-bold px-2 py-0.5 rounded-md">Akun Anda</span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-slate-400">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-xs text-slate-600">
                            <p class="font-medium text-slate-800">{{ $user->phone ?? 'Belum ada no. HP' }}</p>
                            <p class="text-slate-400 mt-0.5 truncate max-w-[180px]">{{ $user->address ?? 'Indonesia' }}</p>
                        </td>
                        <td class="py-4 px-6">
                            @if($user->role === 'admin')
                                <span class="badge-primary inline-flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    Administrator
                                </span>
                            @else
                                <span class="badge-neutral inline-flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Customer
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <span class="font-bold text-slate-800">{{ $user->bookings_count }}x</span>
                        </td>
                        <td class="py-4 px-6 text-xs text-slate-500">
                            {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <!-- Role Toggle Form -->
                                @if($user->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.users.role', $user->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin mengubah peran pengguna ini menjadi {{ $user->role === 'admin' ? 'Customer' : 'Administrator' }}?');">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="role" value="{{ $user->role === 'admin' ? 'customer' : 'admin' }}">
                                        <button type="submit" title="{{ $user->role === 'admin' ? 'Turunkan ke Customer' : 'Jadikan Administrator' }}" class="px-2.5 py-1.5 rounded-lg border text-xs font-semibold {{ $user->role === 'admin' ? 'border-amber-200 bg-amber-50 text-amber-700 hover:bg-amber-100' : 'border-blue-200 bg-blue-50 text-blue-700 hover:bg-blue-100' }} transition-colors">
                                            {{ $user->role === 'admin' ? 'Jadikan Customer' : 'Jadikan Admin' }}
                                        </button>
                                    </form>
                                @endif

                                <!-- Reset Password Button -->
                                <button type="button" onclick="openResetPasswordModal({{ $user->id }}, '{{ addslashes($user->name) }}')" title="Ganti Password" class="p-1.5 rounded-lg border border-slate-200 text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                </button>

                                <!-- Delete Form -->
                                @if($user->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.users.delete', $user->id) }}" onsubmit="return confirm('Hapus akun pengguna {{ addslashes($user->name) }}? Tindakan ini tidak dapat dibatalkan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus Pengguna" class="p-1.5 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
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

<!-- Modal Tambah Akun Baru -->
<div id="modal-add-user" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-xs p-4 hidden">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xl max-w-md w-full p-6 animate-fade-in">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <div>
                <h3 class="text-base font-bold text-slate-900">Tambah Akun Baru</h3>
                <p class="text-xs text-slate-500">Buat akun Administrator atau Customer baru</p>
            </div>
            <button onclick="document.getElementById('modal-add-user').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-xl font-bold">&times;</button>
        </div>

        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="label">Nama Lengkap</label>
                <input type="text" name="name" class="input" placeholder="Nama Lengkap" required>
            </div>

            <div>
                <label class="label">Alamat Email</label>
                <input type="email" name="email" class="input" placeholder="email@domain.com" required>
            </div>

            <div>
                <label class="label">Peran Akun (Role)</label>
                <select name="role" class="input" required>
                    <option value="customer">Customer (Pelanggan Biasa)</option>
                    <option value="admin">Administrator (Hak Akses Penuh)</option>
                </select>
                <p class="text-[11px] text-slate-500 mt-1">Pilih <b>Administrator</b> jika ingin memberi hak akses ke Admin Panel.</p>
            </div>

            <div>
                <label class="label">Nomor Telepon / WhatsApp</label>
                <input type="text" name="phone" class="input" placeholder="08xxxxxxxxxx">
            </div>

            <div>
                <label class="label">Kata Sandi (Password)</label>
                <div class="relative">
                    <input type="password" name="password" id="addUserPassword" class="input pr-10" placeholder="Minimal 8 karakter" required minlength="8">
                    <button type="button" onclick="togglePasswordVisibility('addUserPassword', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none p-1" title="Tampilkan / Sembunyikan Password">
                        <svg class="w-4 h-4 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg class="w-4 h-4 eye-slash hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                    </button>
                </div>
            </div>

            <div>
                <label class="label">Konfirmasi Kata Sandi</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="addUserPasswordConfirm" class="input pr-10" placeholder="Ulangi kata sandi" required minlength="8">
                    <button type="button" onclick="togglePasswordVisibility('addUserPasswordConfirm', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none p-1" title="Tampilkan / Sembunyikan Password">
                        <svg class="w-4 h-4 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg class="w-4 h-4 eye-slash hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                    </button>
                </div>
            </div>

            <div class="pt-3 flex items-center justify-end gap-2 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modal-add-user').classList.add('hidden')" class="btn-secondary text-xs">
                    Batal
                </button>
                <button type="submit" class="btn-primary text-xs">
                    Simpan Akun
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Reset Password -->
<div id="modal-reset-password" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-xs p-4 hidden">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xl max-w-md w-full p-6 animate-fade-in">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <div>
                <h3 class="text-base font-bold text-slate-900">Ganti Kata Sandi</h3>
                <p class="text-xs text-slate-500" id="reset-user-target">Perbarui password akun pengguna</p>
            </div>
            <button onclick="document.getElementById('modal-reset-password').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-xl font-bold">&times;</button>
        </div>

        <form id="form-reset-password" method="POST" action="" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label class="label">Kata Sandi Baru</label>
                <div class="relative">
                    <input type="password" name="password" id="resetPassword" class="input pr-10" placeholder="Minimal 8 karakter" required minlength="8">
                    <button type="button" onclick="togglePasswordVisibility('resetPassword', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none p-1" title="Tampilkan / Sembunyikan Password">
                        <svg class="w-4 h-4 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg class="w-4 h-4 eye-slash hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                    </button>
                </div>
            </div>

            <div>
                <label class="label">Konfirmasi Kata Sandi Baru</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="resetPasswordConfirm" class="input pr-10" placeholder="Ulangi kata sandi baru" required minlength="8">
                    <button type="button" onclick="togglePasswordVisibility('resetPasswordConfirm', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none p-1" title="Tampilkan / Sembunyikan Password">
                        <svg class="w-4 h-4 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg class="w-4 h-4 eye-slash hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                    </button>
                </div>
            </div>

            <div class="pt-3 flex items-center justify-end gap-2 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modal-reset-password').classList.add('hidden')" class="btn-secondary text-xs">
                    Batal
                </button>
                <button type="submit" class="btn-primary text-xs">
                    Perbarui Password
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePasswordVisibility(inputId, btn) {
        const input = document.getElementById(inputId);
        const eyeOpen = btn.querySelector('.eye-open');
        const eyeSlash = btn.querySelector('.eye-slash');
        if (input.type === 'password') {
            input.type = 'text';
            if (eyeOpen) eyeOpen.classList.add('hidden');
            if (eyeSlash) eyeSlash.classList.remove('hidden');
        } else {
            input.type = 'password';
            if (eyeOpen) eyeOpen.classList.remove('hidden');
            if (eyeSlash) eyeSlash.classList.add('hidden');
        }
    }

    function openResetPasswordModal(userId, userName) {
        const modal = document.getElementById('modal-reset-password');
        const form = document.getElementById('form-reset-password');
        const targetText = document.getElementById('reset-user-target');
        
        form.action = `/admin/users/${userId}/password`;
        targetText.textContent = `Perbarui password untuk akun: ${userName}`;
        modal.classList.remove('hidden');
    }
</script>
@endsection


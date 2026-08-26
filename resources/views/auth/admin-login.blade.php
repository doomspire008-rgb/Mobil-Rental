@extends('layouts.app')

@section('title', 'Staff Portal - Access Control')

@section('content')
<div class="min-h-screen flex items-center justify-center pt-28 pb-16 px-4 bg-slate-950 text-white relative">
    <div class="w-full max-w-md relative z-10">
        <!-- Security Header Badge -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900 border border-slate-800 text-blue-400 text-xs font-semibold mb-4 shadow-inner">
                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                Restricted Admin Access
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Portal Manajemen Internal</h1>
            <p class="text-slate-400 text-xs sm:text-sm mt-1.5">Khusus staf pengelola dan administrator sistem RentalMobilku</p>
        </div>

        <!-- Main Card -->
        <div class="bg-slate-900 rounded-2xl border border-slate-800 shadow-2xl p-8">
            @if(session('error'))
                <div class="mb-5 p-3.5 rounded-xl bg-red-950/60 border border-red-800/80 text-red-300 text-xs flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="label text-slate-300">Email Administrator</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="input bg-slate-950 border-slate-800 text-white placeholder-slate-500 focus:border-blue-500" placeholder="admin@domain.com" required autofocus>
                    @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="label text-slate-300">Kata Sandi Khusus</label>
                    <div class="relative">
                        <input type="password" name="password" id="adminPassword" class="input pr-10 bg-slate-950 border-slate-800 text-white placeholder-slate-500 focus:border-blue-500" placeholder="••••••••" required>
                        <button type="button" onclick="togglePasswordVisibility('adminPassword', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-300 focus:outline-none p-1" title="Tampilkan / Sembunyikan Password">
                            <svg class="w-4 h-4 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg class="w-4 h-4 eye-slash hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                        </button>
                    </div>
                    @error('password')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center justify-between py-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded bg-slate-950 border-slate-800 text-blue-600 focus:ring-blue-500">
                        <span class="text-xs text-slate-400">Ingat sesi pada terminal ini</span>
                    </label>
                </div>

                <button type="submit" class="btn-primary w-full py-3 font-bold text-sm shadow-md">
                    Autentikasi & Masuk
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-800 text-center">
                <p class="text-[11px] text-slate-500 flex items-center justify-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    Aktivitas login dan alamat IP dicatat untuk tujuan keamanan.
                </p>
            </div>
        </div>
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
</script>
@endsection

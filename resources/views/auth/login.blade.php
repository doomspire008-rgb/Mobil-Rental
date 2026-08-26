@extends('layouts.app')

@section('title', 'Masuk Akun - RentalMobilku')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center py-20 px-4 bg-slate-50 relative overflow-hidden">
    <!-- Ambient mesh background -->
    <div class="hero-glow w-96 h-96 bg-blue-400/15 top-10 left-1/4"></div>
    <div class="hero-glow w-96 h-96 bg-emerald-400/10 bottom-10 right-1/4"></div>

    <div class="w-full max-w-md relative z-10">
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white shadow-md shadow-blue-500/30">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.5 2.8C2.1 10.9 2 11.4 2 12v4c0 .6.4 1 1 1h2"/>
                        <circle cx="7" cy="17" r="2"/>
                        <path d="M9 17h6"/>
                        <circle cx="17" cy="17" r="2"/>
                    </svg>
                </div>
                <span class="font-extrabold text-2xl tracking-tight text-slate-900">Rental<span class="text-blue-600">Mobilku</span></span>
            </a>
            <h1 class="text-2xl font-bold text-slate-900">Selamat Datang Kembali</h1>
            <p class="text-slate-500 text-sm mt-1">Masuk ke akun Anda untuk mengelola sewa & pesanan</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-xl p-8">
            <!-- 1-Click Demo Login Box -->
            <div class="mb-6 p-4 rounded-xl bg-slate-50 border border-slate-200">
                <div class="flex items-center justify-between mb-2.5">
                    <span class="text-xs font-bold text-slate-700 uppercase tracking-wider">⚡ 1-Click Demo Login</span>
                    <span class="text-[11px] text-blue-600 font-semibold">Cepat & Praktis</span>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ route('quick.login', 'admin') }}" class="btn-dark btn-sm text-center justify-center text-xs">
                        🛡️ Login Admin
                    </a>
                    <a href="{{ route('quick.login', 'customer') }}" class="btn-outline btn-sm text-center justify-center text-xs">
                        👤 Login Customer
                    </a>
                </div>
            </div>

            <div class="relative flex items-center justify-center mb-6">
                <div class="border-t border-slate-200 w-full"></div>
                <span class="bg-white px-3 text-xs text-slate-400 font-medium absolute">atau gunakan email</span>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="label">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="input" placeholder="nama@email.com" required autofocus>
                    @error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="label mb-0">Kata Sandi (Password)</label>
                        <a href="#" class="text-xs font-semibold text-blue-600 hover:text-blue-700">Lupa password?</a>
                    </div>
                    <input type="password" name="password" class="input" placeholder="Masukkan password" required>
                    @error('password')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center justify-between py-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-xs text-slate-600">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <button type="submit" class="btn-primary w-full py-3">
                    Masuk ke Akun
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-100 text-center">
                <p class="text-xs text-slate-500">
                    Belum memiliki akun? 
                    <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-700">Daftar sekarang &rarr;</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Masuk Akun - RentalMobilku')

@section('content')
<div class="min-h-[90vh] flex items-center justify-center pt-32 pb-20 md:pt-36 md:pb-24 px-4 bg-slate-50 relative overflow-hidden">
    <!-- Ambient mesh background -->
    <div class="hero-glow w-96 h-96 bg-blue-400/15 top-10 left-1/4"></div>
    <div class="hero-glow w-96 h-96 bg-emerald-400/10 bottom-10 right-1/4"></div>

    <div class="w-full max-w-md relative z-10">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Selamat Datang Kembali</h1>
            <p class="text-slate-500 text-sm mt-2">Masuk ke akun Anda untuk mengelola sewa & pesanan</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-xl p-8">
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
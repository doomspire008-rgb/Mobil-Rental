@extends('layouts.app')

@section('title', 'Masuk - RentalMobilku')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-white mb-6">
                <svg class="w-8 h-8" style="color: #22c55e;" viewBox="0 0 32 32" fill="none"><rect width="32" height="32" rx="8" fill="currentColor"/><path d="M8 20H24M10 20V14C10 11.79 11.79 10 14 10H18C20.21 10 22 11.79 22 14V20" stroke="white" stroke-width="2.5" stroke-linecap="round"/><circle cx="11" cy="20" r="2" fill="white"/><circle cx="21" cy="20" r="2" fill="white"/></svg>
                <span class="font-bold text-xl">RentalMobilku</span>
            </a>
            <h1 class="text-2xl font-bold text-white mb-2">Selamat Datang Kembali</h1>
            <p class="text-slate-400 text-sm">Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        <div class="bg-white rounded-2xl p-8">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label class="label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="input" placeholder="email@contoh.com" required autofocus>
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-6">
                    <label class="label">Password</label>
                    <input type="password" name="password" class="input" placeholder="Masukkan password" required>
                    @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-neutral-300">
                        <span class="text-sm text-neutral-600">Ingat saya</span>
                    </label>
                    <a href="#" class="text-sm font-medium" style="color: #16a34a;">Lupa password?</a>
                </div>
                <button type="submit" class="btn-primary w-full">Masuk</button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-neutral-500">Belum punya akun? <a href="{{ route('register') }}" class="font-medium" style="color: #16a34a;">Daftar sekarang</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
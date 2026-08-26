@extends('layouts.app')

@section('title', 'Daftar Akun Baru - RentalMobilku')

@section('content')
<div class="min-h-[90vh] flex items-center justify-center pt-32 pb-20 md:pt-36 md:pb-24 px-4 bg-slate-50 relative">
    <div class="w-full max-w-md relative z-10">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Buat Akun Baru</h1>
            <p class="text-slate-500 text-sm mt-2">Daftar dalam 1 menit untuk kemudahan sewa mobil</p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-xl p-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="label">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="input" placeholder="Contoh: Budi Pratama" required autofocus>
                    @error('name')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="label">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="input" placeholder="nama@email.com" required>
                    @error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="label">Nomor WhatsApp / HP</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" class="input" placeholder="081234567890">
                    @error('phone')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="label">Kata Sandi (Password)</label>
                    <input type="password" name="password" class="input" placeholder="Minimal 8 karakter" required>
                    @error('password')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="label">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" class="input" placeholder="Ulangi kata sandi" required>
                </div>

                <div class="pt-2">
                    <button type="submit" class="btn-primary w-full py-3">
                        Daftar Akun Sekarang
                    </button>
                </div>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-100 text-center">
                <p class="text-xs text-slate-500">
                    Sudah memiliki akun? 
                    <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-700">Masuk di sini &rarr;</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
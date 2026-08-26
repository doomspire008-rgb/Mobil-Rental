@extends('layouts.app')

@section('title', 'Booking - RentalMobilku')

@section('content')
<div class="bg-slate-950 text-white pt-28 pb-12">
    <div class="container-custom">
        <h1 class="text-3xl font-bold text-white mb-2">Booking Saya</h1>
        <p class="text-slate-400">Kelola semua booking Anda di sini</p>
    </div>
</div>

<section class="section">
    <div class="container-custom">
        <p class="text-neutral-500">Halaman detail booking akan segera tersedia.</p>
        <a href="{{ route('dashboard') }}" class="btn-primary mt-4 inline-block">Kembali ke Dashboard</a>
    </div>
</section>
@endsection
<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:create {email?} {password?}', function ($email = null, $password = null) {
    $email = $email ?: $this->ask('Masukkan email admin');
    $password = $password ?: $this->secret('Masukkan password admin (min 8 karakter)');
    $name = $this->ask('Masukkan nama admin', 'Administrator');

    if (empty($email) || empty($password)) {
        $this->error('Email dan Password wajib diisi!');
        return;
    }

    $user = User::where('email', $email)->first();

    if ($user) {
        $user->name = $name;
        $user->password = Hash::make($password);
        $user->role = 'admin';
        $user->save();
        $this->info("Akun admin [{$email}] berhasil diperbarui dengan role Administrator!");
    } else {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
        $this->info("Akun admin baru [{$email}] berhasil dibuat dengan role Administrator!");
    }
})->purpose('Buat atau perbarui akun Administrator');


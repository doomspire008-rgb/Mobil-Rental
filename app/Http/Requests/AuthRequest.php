<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return match ($this->route()->getName()) {
            'api.register' => [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'phone' => 'nullable|string|max:15',
                'address' => 'nullable|string',
                'ktp_number' => 'nullable|string|max:20|unique:users',
                'driver_license' => 'nullable|string|max:20|unique:users',
            ],
            'api.login' => [
                'email' => 'required|string|email',
                'password' => 'required|string',
                'remember_me' => 'boolean',
            ],
            'api.forgot-password' => [
                'email' => 'required|string|email|exists:users',
            ],
            'api.reset-password' => [
                'token' => 'required|string',
                'email' => 'required|string|email|exists:users',
                'password' => 'required|string|min:8|confirmed',
            ],
            default => [],
        };
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'email.exists' => 'Email tidak terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'phone.max' => 'Nomor telepon maksimal 15 digit',
            'ktp_number.unique' => 'Nomor KTP sudah terdaftar',
            'driver_license.unique' => 'Nomor SIM sudah terdaftar',
        ];
    }
}
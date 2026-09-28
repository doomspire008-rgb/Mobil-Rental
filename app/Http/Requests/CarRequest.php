<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role === 'admin';
    }

    public function rules(): array
    {
        $id = $this->route('id');
        
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
            'plate_number' => 'required|string|max:15|unique:cars,plate_number,' . $id,
            'price_per_day' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:500',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'string|max:500',
            'seats' => 'required|integer|min:1|max:15',
            'transmission' => 'required|in:manual,automatic',
            'fuel_type' => 'required|in:bensin,diesel,electric',
            'stock' => 'required|integer|min:1',
            'is_available' => 'boolean',
            'status' => 'sometimes|in:available,rented,maintenance',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori wajib dipilih',
            'category_id.exists' => 'Kategori tidak valid',
            'name.required' => 'Nama mobil wajib diisi',
            'brand.required' => 'Merk mobil wajib diisi',
            'model.required' => 'Model mobil wajib diisi',
            'year.required' => 'Tahun mobil wajib diisi',
            'year.min' => 'Tahun minimal 2000',
            'year.max' => 'Tahun maksimal ' . date('Y'),
            'plate_number.required' => 'Nomor polisi wajib diisi',
            'plate_number.unique' => 'Nomor polisi sudah terdaftar',
            'price_per_day.required' => 'Harga per hari wajib diisi',
            'price_per_day.numeric' => 'Harga harus berupa angka',
            'seats.required' => 'Jumlah kursi wajib diisi',
            'transmission.required' => 'Transmisi wajib dipilih',
            'transmission.in' => 'Transmisi harus manual atau automatic',
            'fuel_type.required' => 'Tipe bahan bakar wajib dipilih',
            'fuel_type.in' => 'Tipe bahan bakar harus bensin, diesel, atau electric',
            'stock.required' => 'Stok wajib diisi',
            'stock.min' => 'Stok minimal 1',
        ];
    }
}
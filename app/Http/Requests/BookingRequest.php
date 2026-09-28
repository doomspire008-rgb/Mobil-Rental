<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class BookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'pickup_time' => 'nullable|date_format:H:i',
            'return_time' => 'nullable|date_format:H:i',
            'pickup_location' => 'nullable|string|max:255',
            'return_location' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'car_id.required' => 'Mobil wajib dipilih',
            'car_id.exists' => 'Mobil tidak ditemukan',
            'start_date.required' => 'Tanggal mulai wajib diisi',
            'start_date.after_or_equal' => 'Tanggal mulai tidak boleh sebelum hari ini',
            'end_date.required' => 'Tanggal selesai wajib diisi',
            'end_date.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $carId = $this->car_id;
            $startDate = $this->start_date;
            $endDate = $this->end_date;

            if ($carId && $startDate && $endDate) {
                $bookingService = app(\App\Services\BookingService::class);
                if (!$bookingService->checkAvailability($carId, $startDate, $endDate)) {
                    $validator->errors()->add('car_id', 'Mobil tidak tersedia pada tanggal tersebut');
                }
            }
        });
    }
}
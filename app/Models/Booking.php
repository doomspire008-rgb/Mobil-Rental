<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'start_date',
        'end_date',
        'pickup_time',
        'return_time',
        'total_price',
        'deposit',
        'status',
        'notes',
        'pickup_location',
        'return_location',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'pickup_time' => 'datetime:H:i',
        'return_time' => 'datetime:H:i',
        'total_price' => 'decimal:2',
        'deposit' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }

    protected function durationDays(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->start_date)->diffInDays(Carbon::parse($this->end_date)) + 1,
        );
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Car extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'brand',
        'model',
        'year',
        'plate_number',
        'price_per_day',
        'description',
        'image',
        'gallery_images',
        'status',
        'seats',
        'transmission',
        'fuel_type',
        'is_available',
        'stock',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'price_per_day' => 'decimal:2',
        'is_available' => 'boolean',
        'year' => 'integer',
        'seats' => 'integer',
        'stock' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    protected function averageRating(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->reviews()->avg('rating') ? round($this->reviews()->avg('rating'), 1) : 0,
        );
    }

    protected function reviewsCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->reviews()->count(),
        );
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true)->where('status', 'available');
    }

    public function scopeFeatured($query, $limit = 6)
    {
        return $query->available()
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->latest()
            ->limit($limit);
    }
}

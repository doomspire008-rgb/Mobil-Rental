<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'icon'];

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}

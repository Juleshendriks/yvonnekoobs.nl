<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
        'position',
        'review',
        'rating',
        'avatar',
        'is_featured',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function coachingTypes()
    {
        return $this->morphedByMany(CoachingType::class, 'reviewable');
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'reviewable');
    }
}

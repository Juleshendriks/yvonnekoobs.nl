<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class CoachingType extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'subtitle', 'summary', 'challenges',
        'approach', 'target_audience', 'benefits', 'call_to_action',
        'banner_image', 'sort_order'
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    // Voor route model binding met slug
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Scopes
    public function scopeActive($query)
    {
        // Tijdelijk return alles omdat is_active kolom nog niet bestaat
        return $query;
    }

    public function scopePublished($query)
    {
        // Tijdelijk return alles omdat published_at kolom nog niet bestaat
        return $query;
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    // Relaties
    public function reviews()
    {
        return $this->morphToMany(Review::class, 'reviewable');
    }

    public function faqs()
    {
        return $this->morphToMany(Faq::class, 'faqable');
    }

    // Helper methods
    public function incrementViewCount(): void
    {
        // Tijdelijk disabled omdat view_count kolom nog niet bestaat
        // $this->increment('view_count');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'photo',
        'naam',
        'introduction_title',
        'introduction_description',
        'why_title',
        'why_description',
        'what_title',
        'what_description',
        'how_title',
        'how_description',
        'outro_message',
        'cta_image',
        'cta_description',
        'cta_title',
        'cta_text',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Helper methods voor gemakkelijke toegang
    public function getFotoUrlAttribute(): ?string
    {
        return $this->foto ? asset('storage/' . $this->foto) : null;
    }

    public function getCtaImageUrlAttribute(): ?string
    {
        return $this->cta_image ? asset('storage/' . $this->cta_image) : null;
    }

    // Scope voor het ophalen van het actieve profiel
    public static function active(): ?self
    {
        return static::first();
    }

    // Check of er al een profiel bestaat
    public static function exists(): bool
    {
        return static::count() > 0;
    }
}

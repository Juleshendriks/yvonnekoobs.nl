<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'original_price',
        'is_free',
        'featured_image',
        'gallery_images',
        'file_path',
        'file_name',
        'file_size',
        'file_type',
        'category',
        'tags',
        'is_active',
        'is_featured',
        'published_at',
        'download_limit',
        'download_expiry_days',
        'meta_title',
        'meta_description',
        'sort_order',
        'download_count',
        'view_count',
        'purchase_count',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'is_free' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'gallery_images' => 'array',
        'tags' => 'array',
        'file_size' => 'integer',
        'download_limit' => 'integer',
        'download_expiry_days' => 'integer',
        'sort_order' => 'integer',
        'download_count' => 'integer',
        'view_count' => 'integer',
        'purchase_count' => 'integer',
    ];

    // Route model binding
    public function getRouteKeyName(): string
    {
        return 'slug';
    }


    //Relaties
//    public function orders()
//    {
//        return $this->belongsToMany(Order::class, 'order_items')
//            ->withPivot(['quantity', 'price', 'created_at']);
//    }
//
//    public function users()
//    {
//        return $this->belongsToMany(User::class, 'user_products')
//            ->withPivot(['purchased_at', 'expires_at', 'download_count'])
//            ->withTimestamps();
//    }
//
//    public function downloadLogs()
//    {
//        return $this->hasMany(DownloadLog::class);
//    }

    // Polymorfe relaties voor FAQs en Reviews
    public function faqs()
    {
        return $this->morphToMany(Faq::class, 'faqable');
    }

    public function reviews()
    {
        return $this->morphToMany(Review::class, 'reviewable');
    }

    // Scopes
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published_at', '<=', now());
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeFree(Builder $query): Builder
    {
        return $query->where('is_free', true)->orWhere('price', 0);
    }

    public function scopePaid(Builder $query): Builder
    {
        return $query->where('is_free', false)->where('price', '>', 0);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function scopeByCategory(Builder $query, $categoryId): Builder
    {
        return $query->where('product_category_id', $categoryId);
    }

    public function scopeWithTag(Builder $query, string $tag): Builder
    {
        return $query->whereJsonContains('tags', $tag);
    }

    // Accessors
    public function getFormattedPriceAttribute(): string
    {
        if ($this->is_free || $this->price == 0) {
            return 'Gratis';
        }

        return '€ ' . number_format($this->price, 2, ',', '.');
    }

    public function getFormattedOriginalPriceAttribute(): string
    {
        if (!$this->original_price) {
            return '';
        }

        return '€ ' . number_format($this->original_price, 2, ',', '.');
    }

    public function getFormattedFileSizeAttribute(): string
    {
        if (!$this->file_size) {
            return 'Onbekend';
        }

        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->featured_image ? Storage::url($this->featured_image) : null;
    }

    public function getGalleryImageUrlsAttribute(): array
    {
        if (!$this->gallery_images) {
            return [];
        }

        return collect($this->gallery_images)
            ->map(fn($image) => Storage::url($image))
            ->toArray();
    }

    public function getAverageRatingAttribute(): float
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function getReviewsCountAttribute(): int
    {
        return $this->reviews()->count();
    }

    public function getPublishedFaqsAttribute()
    {
        return $this->faqs()->where('is_active', true)->ordered()->get();
    }

    public function getPublishedReviewsAttribute()
    {
        return $this->reviews()->where('is_active', true)->ordered()->get();
    }

    // Mutators
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        // Auto-generate slug if not set
        if (empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value;

        // Auto-set is_free based on price
        $this->attributes['is_free'] = $value == 0;
    }

    // Helper methods
    public function isPurchasedBy(User $user): bool
    {
        return $this->users()->where('user_id', $user->id)->exists();
    }

    public function canBeDownloadedBy(User $user): bool
    {
        $userProduct = $this->users()->where('user_id', $user->id)->first();

        if (!$userProduct) {
            return false;
        }

        // Check expiry
        if ($userProduct->pivot->expires_at && $userProduct->pivot->expires_at < now()) {
            return false;
        }

        // Check download limit
        if ($this->download_limit && $userProduct->pivot->download_count >= $this->download_limit) {
            return false;
        }

        return true;
    }

    public function getRemainingDownloadsFor(User $user): ?int
    {
        if (!$this->download_limit) {
            return null; // Unlimited
        }

        $userProduct = $this->users()->where('user_id', $user->id)->first();

        if (!$userProduct) {
            return 0;
        }

        return max(0, $this->download_limit - $userProduct->pivot->download_count);
    }

    public function incrementViewCount(): void
    {
        $this->increment('view_count');
    }

    public function incrementDownloadCount(): void
    {
        $this->increment('download_count');
    }

    public function incrementPurchaseCount(): void
    {
        $this->increment('purchase_count');
    }

    public function hasDiscount(): bool
    {
        return $this->original_price && $this->original_price > $this->price;
    }

    public function getDiscountPercentage(): int
    {
        if (!$this->hasDiscount()) {
            return 0;
        }

        return round((($this->original_price - $this->price) / $this->original_price) * 100);
    }

    public function getDiscountAmount(): float
    {
        if (!$this->hasDiscount()) {
            return 0;
        }

        return $this->original_price - $this->price;
    }

    public function isPublished(): bool
    {
        return $this->is_active &&
            $this->published_at &&
            $this->published_at <= now();
    }

    public function hasFile(): bool
    {
        return !empty($this->file_path) && Storage::exists($this->file_path);
    }

    public function getFileUrl(): ?string
    {
        if (!$this->hasFile()) {
            return null;
        }

        return Storage::url($this->file_path);
    }

    public function generateSecureDownloadUrl(User $user): ?string
    {
        if (!$this->canBeDownloadedBy($user)) {
            return null;
        }

        // Generate signed URL that expires in 1 hour
        return route('products.download', [
            'product' => $this->slug,
            'user' => $user->id,
            'signature' => hash_hmac('sha256', $this->id . $user->id . time(), config('app.key'))
        ]);
    }

    // Static methods
    public static function getFeatured(int $limit = 6)
    {
        return self::active()
            ->published()
            ->featured()
            ->ordered()
            ->limit($limit)
            ->get();
    }

    public static function getLatest(int $limit = 12)
    {
        return self::active()
            ->published()
            ->latest('published_at')
            ->limit($limit)
            ->get();
    }

    public static function getFreeProducts(int $limit = null)
    {
        $query = self::active()
            ->published()
            ->free()
            ->ordered();

        return $limit ? $query->limit($limit)->get() : $query->get();
    }

    public static function getPaidProducts(int $limit = null)
    {
        $query = self::active()
            ->published()
            ->paid()
            ->ordered();

        return $limit ? $query->limit($limit)->get() : $query->get();
    }
}

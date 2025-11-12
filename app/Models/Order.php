<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'subtotal',
        'total',
        'currency',
        'status',
        'customer_email',
        'customer_name',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    // Relaties
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
            ->withPivot(['quantity', 'price'])
            ->withTimestamps();
    }

    // Scopes
    public function scopePaid(Builder $query): Builder
    {
        return $query->where('status', 'paid');
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeFailed(Builder $query): Builder
    {
        return $query->where('status', 'failed');
    }

    public function scopeForUser(Builder $query, User $user): Builder
    {
        return $query->where('user_id', $user->id);
    }

    // Accessors
    public function getFormattedTotalAttribute(): string
    {
        return '€ ' . number_format($this->total, 2, ',', '.');
    }

    public function getFormattedSubtotalAttribute(): string
    {
        return '€ ' . number_format($this->subtotal, 2, ',', '.');
    }

    public function getLatestPaymentAttribute(): ?Payment
    {
        return $this->payments()->latest()->first();
    }

    public function getIsPaidAttribute(): bool
    {
        return $this->status === 'paid';
    }

    public function getIsPendingAttribute(): bool
    {
        return $this->status === 'pending';
    }

    public function getIsFailedAttribute(): bool
    {
        return $this->status === 'failed';
    }

    // Helper methods
    public function markAsPaid(): void
    {
        $this->update(['status' => 'paid']);

        // Geef gebruiker toegang tot producten
        $this->grantProductAccess();
    }

    public function markAsFailed(): void
    {
        $this->update(['status' => 'failed']);
    }

    public function markAsCancelled(): void
    {
        $this->update(['status' => 'cancelled']);
    }

    public function grantProductAccess(): void
    {
        foreach ($this->items as $item) {
            // Check of user al toegang heeft
            $existingAccess = $this->user->products()
                ->where('product_id', $item->product_id)
                ->exists();

            if (!$existingAccess) {
                $expiresAt = null;

                // Bereken expiry date als product een limiet heeft
                if ($item->product->download_expiry_days) {
                    $expiresAt = now()->addDays($item->product->download_expiry_days);
                }

                $this->user->products()->attach($item->product_id, [
                    'order_id' => $this->id,
                    'purchased_at' => now(),
                    'expires_at' => $expiresAt,
                    'download_count' => 0,
                ]);

                // Update product statistics
                $item->product->incrementPurchaseCount();
            }
        }
    }

    public function calculateTotals(): void
    {
        $subtotal = $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $this->update([
            'subtotal' => $subtotal,
            'total' => $subtotal, // Later kun je hier BTW toevoegen
        ]);
    }

    public function hasProduct(Product $product): bool
    {
        return $this->items()->where('product_id', $product->id)->exists();
    }

    public function getTotalItems(): int
    {
        return $this->items->sum('quantity');
    }

    // Static methods
    public static function generateOrderNumber(): string
    {
        $date = now()->format('Ymd');
        $random = str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT);

        return "ORD-{$date}-{$random}";
    }

    public static function createForUser(User $user, array $products): self
    {
        $order = self::create([
            'order_number' => self::generateOrderNumber(),
            'user_id' => $user->id,
            'customer_email' => $user->email,
            'customer_name' => $user->name,
            'subtotal' => 0,
            'total' => 0,
            'status' => 'pending',
        ]);

        // Voeg producten toe
        foreach ($products as $productData) {
            $product = Product::find($productData['product_id']);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => $productData['quantity'] ?? 1,
                'price' => $product->price,
            ]);
        }

        // Bereken totalen
        $order->calculateTotals();

        return $order->fresh(['items']);
    }

    public static function createFreeOrder(User $user, Product $product): self
    {
        $order = self::create([
            'order_number' => self::generateOrderNumber(),
            'user_id' => $user->id,
            'customer_email' => $user->email,
            'customer_name' => $user->name,
            'subtotal' => 0,
            'total' => 0,
            'status' => 'paid', // Gratis = direct betaald
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'quantity' => 1,
            'price' => 0,
        ]);

        // Direct toegang verlenen
        $order->grantProductAccess();

        return $order;
    }
}

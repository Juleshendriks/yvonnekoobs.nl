<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'mollie_payment_id',
        'mollie_checkout_url',
        'status',
        'method',
        'amount',
        'currency',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    // Relaties
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Scopes
    public function scopePaid(Builder $query): Builder
    {
        return $query->where('status', 'paid');
    }

    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('status', 'open');
    }

    public function scopeFailed(Builder $query): Builder
    {
        return $query->where('status', 'failed');
    }

    public function scopeByMollieId(Builder $query, string $mollieId): Builder
    {
        return $query->where('mollie_payment_id', $mollieId);
    }

    // Accessors
    public function getFormattedAmountAttribute(): string
    {
        return '€ ' . number_format($this->amount, 2, ',', '.');
    }

    public function getIsPaidAttribute(): bool
    {
        return $this->status === 'paid';
    }

    public function getIsOpenAttribute(): bool
    {
        return $this->status === 'open';
    }

    public function getIsFailedAttribute(): bool
    {
        return in_array($this->status, ['failed', 'cancelled', 'expired']);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'open' => 'Wachtend op betaling',
            'paid' => 'Betaald',
            'failed' => 'Mislukt',
            'cancelled' => 'Geannuleerd',
            'expired' => 'Verlopen',
            default => 'Onbekend',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'open' => 'warning',
            'paid' => 'success',
            'failed' => 'danger',
            'cancelled' => 'secondary',
            'expired' => 'danger',
            default => 'secondary',
        };
    }

    public function getMethodLabelAttribute(): string
    {
        return match($this->method) {
            'ideal' => 'iDEAL',
            'creditcard' => 'Creditcard',
            'bancontact' => 'Bancontact',
            'sofort' => 'SOFORT',
            'eps' => 'EPS',
            'giropay' => 'Giropay',
            'kbc' => 'KBC',
            'belfius' => 'Belfius',
            'przelewy24' => 'Przelewy24',
            'applepay' => 'Apple Pay',
            'paypal' => 'PayPal',
            default => $this->method ? ucfirst($this->method) : 'Onbekend',
        };
    }

    // Helper methods
    public function markAsPaid(): void
    {
        $this->update(['status' => 'paid']);

        // Update de order status
        $this->order->markAsPaid();
    }

    public function markAsFailed(): void
    {
        $this->update(['status' => 'failed']);

        // Update de order status
        $this->order->markAsFailed();
    }

    public function markAsCancelled(): void
    {
        $this->update(['status' => 'cancelled']);

        // Update de order status
        $this->order->markAsCancelled();
    }

    public function markAsExpired(): void
    {
        $this->update(['status' => 'expired']);
    }

    public function updateFromMollie(\Mollie\Api\Resources\Payment $molliePayment): void
    {
        $this->update([
            'status' => $molliePayment->status,
            'method' => $molliePayment->method,
        ]);

        // Update order status based on payment status
        match($molliePayment->status) {
            'paid' => $this->markAsPaid(),
            'failed' => $this->markAsFailed(),
            'cancelled' => $this->markAsCancelled(),
            'expired' => $this->markAsExpired(),
            default => null,
        };
    }

    // Static methods
    public static function createForOrder(Order $order, string $molliePaymentId, string $checkoutUrl): self
    {
        return self::create([
            'order_id' => $order->id,
            'mollie_payment_id' => $molliePaymentId,
            'mollie_checkout_url' => $checkoutUrl,
            'amount' => $order->total,
            'currency' => $order->currency,
            'status' => 'open',
        ]);
    }

    public static function findByMollieId(string $mollieId): ?self
    {
        return self::byMollieId($mollieId)->first();
    }
}

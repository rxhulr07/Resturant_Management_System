<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Plate extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'customer_name',
        'customer_phone',
        'address',
        'order_number',
        'total_amount',
        'status',
        'pickup_time'
    ];

    protected $casts = [
        'pickup_time' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($plate) {
            $plate->order_number = 'ORD-' . strtoupper(Str::random(8));
            $plate->status = 'pending';
        });
    }

    public function items(): HasMany
    {
        return $this->hasMany(PlateItem::class);
    }

    public function calculateTotal(): float
    {
        return $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'processing' => 'bg-blue-100 text-blue-800',
            'ready' => 'bg-green-100 text-green-800',
            'completed' => 'bg-gray-100 text-gray-800',
            'cancelled' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getStatusTextAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Order Pending',
            'processing' => 'Processing',
            'ready' => 'Ready for Pickup',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            default => ucfirst($this->status),
        };
    }

    public function markAsPaid($paymentId)
    {
        $this->update([
            'status' => 'paid',
            'payment_id' => $paymentId
        ]);
    }

    public function markAsReady()
    {
        $this->update(['status' => 'ready']);
    }

    public function markAsCollected()
    {
        $this->update(['status' => 'collected']);
    }
}

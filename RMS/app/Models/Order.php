<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'email',
        'status',
        'total_amount',
        'pickup_time',
    ];

    protected $casts = [
        'pickup_time' => 'datetime',
        'total_amount' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateOrderNumber()
    {
        $prefix = 'ORD-';
        $random = strtoupper(substr(uniqid(), -8));
        return $prefix . $random;
    }
}

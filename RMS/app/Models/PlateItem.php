<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlateItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_id',
        'dish_id',
        'quantity',
        'price',
        'special_instructions'
    ];

    public function plate()
    {
        return $this->belongsTo(Plate::class);
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }

    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->price;
    }
}

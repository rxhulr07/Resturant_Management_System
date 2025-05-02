<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'is_available'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function getDefaultImage()
    {
        $defaultImages = [
            'appetizer' => 'https://images.unsplash.com/photo-1541014741259-de529411b96a?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            'main course' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            'dessert' => 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            'beverage' => 'https://images.unsplash.com/photo-1544145945-f90425340c7e?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            'default' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'
        ];

        $category = strtolower($this->category->name);
        return $defaultImages[$category] ?? $defaultImages['default'];
    }
}

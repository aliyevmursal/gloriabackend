<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductSize extends Pivot
{
    protected $table = 'product_sizes';
    
    protected $fillable = [
        'product_id',
        'size_id',
        'price',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    protected $appends = ['discounted_price', 'discount'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function getDiscountedPriceAttribute()
    {
        $discount = $this->product->getActiveDiscount();

        if (!$discount) {
            return $this->price;
        }

        $discountedPrice = $this->price;

        if ($discount->type === 'percentage') {
            $discountedPrice = $this->price - ($this->price * $discount->value / 100);
        } else {
            $discountedPrice = max(0, $this->price - $discount->value);
        }

        return number_format($discountedPrice, 2);
    }

    public function getDiscountAttribute()
    {
        return $this->product->getActiveDiscount();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

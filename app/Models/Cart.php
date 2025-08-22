<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'size_id',
        'color_id',
        'quantity'
    ];

    protected $appends = ['total_price', 'price', 'discounted_price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function getTotalPriceAttribute()
    {
        if (!$this->size_id) {
            return 0;
        }

        $productSize = $this->product->sizes()
            ->where('size_id', $this->size_id)
            ->withPivot(['price', 'is_active'])
            ->first();

        if (!$productSize || !$productSize->pivot->is_active) {
            return 0;
        }

        $price = $productSize->pivot->price;
        $discount = $this->product->getActiveDiscount();

        if ($discount) {
            if ($discount->type === 'percentage') {
                $price = $price - ($price * $discount->value / 100);
            } else {
                $price = max(0, $price - $discount->value);
            }
        }

        return $this->quantity * $price;
    }

    public function getPriceAttribute()
    {
        if (!$this->size_id) {
            return 0;
        }

        $productSize = $this->product->sizes()
            ->where('size_id', $this->size_id)
            ->withPivot(['price', 'is_active'])
            ->first();

        if (!$productSize || !$productSize->pivot->is_active) {
            return 0;
        }

        return $productSize->pivot->price;
    }

    public function getDiscountedPriceAttribute()
    {
        if (!$this->size_id) {
            return 0;
        }

        $productSize = $this->product->sizes()
            ->where('size_id', $this->size_id)
            ->withPivot(['price', 'is_active'])
            ->first();

        if (!$productSize || !$productSize->pivot->is_active) {
            return 0;
        }

        $price = $productSize->pivot->price;
        $discount = $this->product->getActiveDiscount();

        if ($discount) {
            if ($discount->type === 'percentage') {
                $price = $price - ($price * $discount->value / 100);
            } else {
                $price = max(0, $price - $discount->value);
            }
        }

        return $price;
    }
}
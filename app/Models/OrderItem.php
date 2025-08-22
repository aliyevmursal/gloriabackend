<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'size_id',
        'color_id',
        'product_name_az',
        'product_name_en',
        'product_name_ru',
        'product_description_az',
        'product_description_en',
        'product_description_ru',
        'product_cover',
        'product_price',
        'product_discounted_price',
        'quantity',
        'total_price',
        'product_categories',
        'product_colors',
        'product_sizes'
    ];

    protected $casts = [
        'product_price' => 'decimal:2',
        'product_discounted_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'product_categories' => 'array',
        'product_colors' => 'array',
        'product_sizes' => 'array',
    ];

    protected $appends = ['product_name', 'product_description', 'product_cover_url'];

    public function order()
    {
        return $this->belongsTo(Order::class);
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

    public function getProductNameAttribute()
    {
        return [
            'az' => $this->product_name_az,
            'en' => $this->product_name_en,
            'ru' => $this->product_name_ru,
        ];
    }

    public function getProductDescriptionAttribute()
    {
        return [
            'az' => $this->product_description_az,
            'en' => $this->product_description_en,
            'ru' => $this->product_description_ru,
        ];
    }

    public function getProductCoverUrlAttribute()
    {
        return asset("storage/{$this->product_cover}");
    }
}
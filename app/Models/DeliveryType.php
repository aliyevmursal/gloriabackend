<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryType extends Model
{
    protected $fillable = [
        'title_az',
        'title_en',
        'title_ru',
        'price',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    protected $appends = ['title'];

    protected $hidden = ['title_az', 'title_en', 'title_ru', 'is_active', 'created_at', 'updated_at'];

    public function getTitleAttribute()
    {
        return [
            'az' => $this->title_az,
            'en' => $this->title_en,
            'ru' => $this->title_ru,
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

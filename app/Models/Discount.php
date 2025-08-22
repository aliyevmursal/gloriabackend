<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'name_az',
        'name_en',
        'type',
        'value',
        'start_date',
        'end_date',
        'is_active'
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    protected $appends = ['name'];

    protected $hidden = ['name_az', 'name_en', 'updated_at'];

    public function getNameAttribute()
    {
        return [
            'az' => $this->name_az,
            'en' => $this->name_en,
        ];
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'discount_categories');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where('start_date', '<=', now())
                    ->where('end_date', '>=', now());
    }
}
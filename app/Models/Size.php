<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['name'];

    protected $hidden = ['name_az', 'name_en', 'is_active', 'created_at', 'updated_at'];

    public function getNameAttribute()
    {
        return [
            'az' => $this->name_az,
            'en' => $this->name_en,
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
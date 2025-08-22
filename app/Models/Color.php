<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'name_az',
        'name_en',
        'name_ru',
        'code',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['name'];

    protected $hidden = ['name_az', 'name_en', 'name_ru', 'is_active', 'created_at', 'updated_at'];

    public function getNameAttribute()
    {
        return [
            'az' => $this->name_az,
            'en' => $this->name_en,
            'ru' => $this->name_ru,
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
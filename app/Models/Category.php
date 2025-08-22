<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name_az',
        'name_en',
        'slug',
        'is_active',
        'position',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['name'];

    protected $hidden = ['name_az', 'name_en', 'created_at', 'updated_at', 'is_active', 'position'];

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

    public function scopeOrderByPosition($query)
    {
        return $query->orderBy('position', 'asc');
    }
}

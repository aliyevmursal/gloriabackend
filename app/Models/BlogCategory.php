<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $fillable = [
        'name_az',
        'name_en',
        'slug',
        'is_active',
    ];

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
}

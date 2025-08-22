<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title_az',
        'title_en',
        'title_ru',
        'slogan_az',
        'slogan_en',
        'slogan_ru',
        'helper_text_az',
        'helper_text_en',
        'helper_text_ru',
        'cover',
        'link',
        'position',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['cover_url', 'title', 'slogan', 'helper_text'];

    protected $hidden = ['cover', 'title_az', 'title_en', 'title_ru', 'position', 'is_active', 'created_at', 'updated_at', 'slogan_az', 'slogan_en', 'slogan_ru', 'helper_text_az', 'helper_text_en', 'helper_text_ru'];

    public function getCoverUrlAttribute()
    {
        return asset("storage/{$this->cover}");
    }

    public function getTitleAttribute()
    {
        return [
            'az' => $this->title_az,
            'en' => $this->title_en,
            'ru' => $this->title_ru,
        ];
    }

    public function getSloganAttribute()
    {
        return [
            'az' => $this->slogan_az,
            'en' => $this->slogan_en,
            'ru' => $this->slogan_ru,
        ];
    }

    public function getHelperTextAttribute()
    {
        return [
            'az' => $this->helper_text_az,
            'en' => $this->helper_text_en,
            'ru' => $this->helper_text_ru,
        ];
    }
}

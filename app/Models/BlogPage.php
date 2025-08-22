<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPage extends Model
{
    protected $fillable = [
        'title_en',
        'title_az',
        'description_en',
        'description_az',
        'meta_title_en',
        'meta_title_az',
        'meta_description_en',
        'meta_description_az',
        'meta_keywords_en',
        'meta_keywords_az',
        'og_title_en',
        'og_title_az',
        'og_description_en',
        'og_description_az',
        'og_image',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected $appends = ['title', 'description', 'meta_title', 'meta_description', 'meta_keywords', 'og_title', 'og_description'];

    protected $hidden = [
        'title_en',
        'title_az',
        'description_en',
        'description_az',
        'meta_title_en',
        'meta_title_az',
        'meta_description_en',
        'meta_description_az',
        'meta_keywords_en',
        'meta_keywords_az',
        'og_title_en',
        'og_title_az',
        'og_description_en',
        'og_description_az',
        'created_at',
        'updated_at',
    ];

    public function getTitleAttribute()
    {
        return [
            'az' => $this->title_az,
            'en' => $this->title_en,
        ];
    }

    public function getDescriptionAttribute()
    {
        return [
            'az' => $this->description_az,
            'en' => $this->description_en,
        ];
    }

    public function getMetaTitleAttribute()
    {
        return [
            'az' => $this->meta_title_az,
            'en' => $this->meta_title_en,
        ];
    }

    public function getMetaDescriptionAttribute()
    {
        return [
            'az' => $this->meta_description_az,
            'en' => $this->meta_description_en,
        ];
    }

    public function getMetaKeywordsAttribute()
    {
        return [
            'az' => $this->meta_keywords_az,
            'en' => $this->meta_keywords_en,
        ];
    }

    public function getOgTitleAttribute()
    {
        return [
            'az' => $this->og_title_az,
            'en' => $this->og_title_en,
        ];
    }

    public function getOgDescriptionAttribute()
    {
        return [
            'az' => $this->og_description_az,
            'en' => $this->og_description_en,
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'blog_category_id',
        'name_az',
        'name_en',
        'name_ru',
        'description_az',
        'description_en',
        'description_ru',
        'meta_title_en',
        'meta_title_az',
        'meta_title_ru',
        'meta_description_en',
        'meta_description_az',
        'meta_description_ru',
        'meta_keywords_en',
        'meta_keywords_az',
        'meta_keywords_ru',
        'og_title_en',
        'og_title_az',
        'og_title_ru',
        'og_description_en',
        'og_description_az',
        'og_description_ru',
        'og_image',
        'cover',
        'slug',
        'view_count',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $hidden = [
        'blog_category_id', 'name_az', 'name_en', 'name_ru', 'updated_at', 
        'description_az', 'description_en', 'description_ru', 'is_active', 'cover',
        'meta_title_en', 'meta_title_az', 'meta_title_ru',
        'meta_description_en', 'meta_description_az', 'meta_description_ru',
        'meta_keywords_en', 'meta_keywords_az', 'meta_keywords_ru',
        'og_title_en', 'og_title_az', 'og_title_ru',
        'og_description_en', 'og_description_az', 'og_description_ru',
        'og_image'
    ];

    protected $appends = ['name', 'description', 'cover_url', 'meta_title', 'meta_description', 'meta_keywords', 'og_title', 'og_description'];

    public function getNameAttribute()
    {
        return [
            'az' => $this->name_az,
            'en' => $this->name_en,
            'ru' => $this->name_ru,
        ];
    }

    public function getDescriptionAttribute()
    {
        return [
            'az' => $this->description_az,
            'en' => $this->description_en,
            'ru' => $this->description_ru,
        ];
    }

    public function getCoverUrlAttribute()
    {
        return asset("storage/{$this->cover}");
    }

    public function getMetaTitleAttribute()
    {
        return [
            'az' => $this->meta_title_az,
            'en' => $this->meta_title_en,
            'ru' => $this->meta_title_ru,
        ];
    }

    public function getMetaDescriptionAttribute()
    {
        return [
            'az' => $this->meta_description_az,
            'en' => $this->meta_description_en,
            'ru' => $this->meta_description_ru,
        ];
    }

    public function getMetaKeywordsAttribute()
    {
        return [
            'az' => $this->meta_keywords_az,
            'en' => $this->meta_keywords_en,
            'ru' => $this->meta_keywords_ru,
        ];
    }

    public function getOgTitleAttribute()
    {
        return [
            'az' => $this->og_title_az,
            'en' => $this->og_title_en,
            'ru' => $this->og_title_ru,
        ];
    }

    public function getOgDescriptionAttribute()
    {
        return [
            'az' => $this->og_description_az,
            'en' => $this->og_description_en,
            'ru' => $this->og_description_ru,
        ];
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id', 'id');
    }
}

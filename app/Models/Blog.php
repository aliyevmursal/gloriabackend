<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'blog_category_id',
        'name_az',
        'name_en',
        'description_az',
        'description_en',
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
        'cover',
        'slug',
        'view_count',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $hidden = [
        'blog_category_id', 'name_az', 'name_en', 'updated_at', 
        'description_az', 'description_en', 'is_active', 'cover',
        'meta_title_en', 'meta_title_az',
        'meta_description_en', 'meta_description_az',
        'meta_keywords_en', 'meta_keywords_az',
        'og_title_en', 'og_title_az',
        'og_description_en', 'og_description_az',
        'og_image'
    ];

    protected $appends = ['name', 'description', 'cover_url', 'meta_title', 'meta_description', 'meta_keywords', 'og_title', 'og_description'];

    public function getNameAttribute()
    {
        return [
            'az' => $this->name_az,
            'en' => $this->name_en,
        ];
    }

    public function getDescriptionAttribute()
    {
        return [
            'az' => $this->description_az,
            'en' => $this->description_en,
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

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id', 'id');
    }
}

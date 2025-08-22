<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $fillable = [
        'description_en',
        'description_az',
        'description_ru',
        'video_url',
        'quality_title_en',
        'quality_title_az',
        'quality_title_ru',
        'quality_description_en',
        'quality_description_az',
        'quality_description_ru',
        'individual_approach_title_en',
        'individual_approach_title_az',
        'individual_approach_title_ru',
        'individual_approach_description_en',
        'individual_approach_description_az',
        'individual_approach_description_ru',
        'worldwide_shipping_title_en',
        'worldwide_shipping_title_az',
        'worldwide_shipping_title_ru',
        'worldwide_shipping_description_en',
        'worldwide_shipping_description_az',
        'worldwide_shipping_description_ru',
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
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected $appends = [
        'description',
        'quality_title',
        'quality_description',
        'individual_approach_title',
        'individual_approach_description',
        'worldwide_shipping_title',
        'worldwide_shipping_description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description'
    ];

    protected $hidden = [
        'description_en',
        'description_az',
        'description_ru',
        'quality_title_en',
        'quality_title_az',
        'quality_title_ru',
        'quality_description_en',
        'quality_description_az',
        'quality_description_ru',
        'individual_approach_title_en',
        'individual_approach_title_az',
        'individual_approach_title_ru',
        'individual_approach_description_en',
        'individual_approach_description_az',
        'individual_approach_description_ru',
        'worldwide_shipping_title_en',
        'worldwide_shipping_title_az',
        'worldwide_shipping_title_ru',
        'worldwide_shipping_description_en',
        'worldwide_shipping_description_az',
        'worldwide_shipping_description_ru',
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
        'created_at',
        'updated_at',
    ];

    public function getDescriptionAttribute()
    {
        return [
            'az' => $this->description_az,
            'en' => $this->description_en,
            'ru' => $this->description_ru,
        ];
    }

    public function getQualityTitleAttribute()
    {
        return [
            'az' => $this->quality_title_az,
            'en' => $this->quality_title_en,
            'ru' => $this->quality_title_ru,
        ];
    }

    public function getQualityDescriptionAttribute()
    {
        return [
            'az' => $this->quality_description_az,
            'en' => $this->quality_description_en,
            'ru' => $this->quality_description_ru,
        ];
    }

    public function getIndividualApproachTitleAttribute()
    {
        return [
            'az' => $this->individual_approach_title_az,
            'en' => $this->individual_approach_title_en,
            'ru' => $this->individual_approach_title_ru,
        ];
    }

    public function getIndividualApproachDescriptionAttribute()
    {
        return [
            'az' => $this->individual_approach_description_az,
            'en' => $this->individual_approach_description_en,
            'ru' => $this->individual_approach_description_ru,
        ];
    }

    public function getWorldwideShippingTitleAttribute()
    {
        return [
            'az' => $this->worldwide_shipping_title_az,
            'en' => $this->worldwide_shipping_title_en,
            'ru' => $this->worldwide_shipping_title_ru,
        ];
    }

    public function getWorldwideShippingDescriptionAttribute()
    {
        return [
            'az' => $this->worldwide_shipping_description_az,
            'en' => $this->worldwide_shipping_description_en,
            'ru' => $this->worldwide_shipping_description_ru,
        ];
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
}
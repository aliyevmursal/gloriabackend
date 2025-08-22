<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name_az',
        'name_en',
        'name_ru',
        'description_az',
        'description_en',
        'description_ru',
        'cover',
        'gallery',
        'price',
        'slug',
        'is_active',
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    protected $appends = ['name', 'description', 'cover_url', 'gallery_urls', 'discounted_price', 'discount'];

    protected $hidden = [
        'name_az',
        'name_en',
        'name_ru',
        'description_az',
        'description_en',
        'description_ru',
        'cover',
        'gallery',
        'is_active',
        'updated_at'
    ];

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

    public function getGalleryUrlsAttribute()
    {
        if (!$this->gallery) {
            return [];
        }

        return array_map(function ($image) {
            return asset("storage/{$image}");
        }, $this->gallery);
    }

    public function getDiscountedPriceAttribute()
    {
        $discount = $this->getActiveDiscount();

        $discountedPrice = $this->price;

        if (!$discount) {
            return $this->price;
        }

        if ($discount) {
            if ($discount->type === 'percentage') {
                $discountedPrice = $this->price - ($this->price * $discount->value / 100);
            } else {
                $discountedPrice = max(0, $this->price - $discount->value);
            }
        }

        return number_format($discountedPrice, 2);
    }

    public function getDiscountAttribute()
    {
        $discount = $this->getActiveDiscount();

        if (!$discount) {
            return null;
        }

        return $discount;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_colors');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes');
    }

    public function getActiveDiscount()
    {
        $categoryIds = $this->categories()->pluck('categories.id');

        return Discount::where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            })
            ->orderBy('value', 'desc')
            ->first();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategories($query, $categoryIds)
    {
        if (empty($categoryIds)) {
            return $query;
        }

        return $query->whereHas('categories', function ($q) use ($categoryIds) {
            $q->whereIn('categories.id', $categoryIds);
        });
    }

    public function scopeByCategorySlugs($query, $categorySlugs)
    {
        if (empty($categorySlugs)) {
            return $query;
        }

        return $query->whereHas('categories', function ($q) use ($categorySlugs) {
            $q->whereIn('categories.slug', $categorySlugs);
        });
    }

    public function scopeByPriceRange($query, $minPrice = null, $maxPrice = null)
    {
        if ($minPrice !== null) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice !== null) {
            $query->where('price', '<=', $maxPrice);
        }

        return $query;
    }

    public function scopeSearch($query, $search, $locale = 'en')
    {
        if (empty($search)) {
            return $query;
        }

        $nameColumn = "name_{$locale}";
        $descriptionColumn = "description_{$locale}";

        return $query->where(function ($q) use ($search, $nameColumn, $descriptionColumn) {
            $q->where($nameColumn, 'like', "%{$search}%")
                ->orWhere($descriptionColumn, 'like', "%{$search}%");
        });
    }
}
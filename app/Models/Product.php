<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductSize;

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
        'slug',
        'is_active',
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_active' => 'boolean',
    ];

    protected $appends = ['name', 'description', 'cover_url', 'gallery_urls', 'sizes_with_prices'];

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

    public function getSizesWithPricesAttribute()
    {
        return $this->sizes()->withPivot(['price', 'is_active'])->get()->map(function ($size) {
            $discount = $this->getActiveDiscount();
            $price = $size->pivot->price;
            $discountedPrice = $price;

            if ($discount) {
                if ($discount->type === 'percentage') {
                    $discountedPrice = $price - ($price * $discount->value / 100);
                } else {
                    $discountedPrice = max(0, $price - $discount->value);
                }
            }

            return [
                'id' => $size->id,
                'name' => $size->name,
                'price' => number_format($price, 2),
                'discounted_price' => number_format($discountedPrice, 2),
                'discount' => $discount,
                'is_active' => $size->pivot->is_active,
            ];
        })->where('is_active', true);
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
        return $this->belongsToMany(Size::class, 'product_sizes')
            ->using(ProductSize::class)
            ->withPivot(['price', 'is_active'])
            ->withTimestamps();
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
        if ($minPrice !== null || $maxPrice !== null) {
            $query->whereHas('sizes', function ($q) use ($minPrice, $maxPrice) {
                if ($minPrice !== null) {
                    $q->where('product_sizes.price', '>=', $minPrice);
                }
                if ($maxPrice !== null) {
                    $q->where('product_sizes.price', '<=', $maxPrice);
                }
            });
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

        // Validate locale to prevent SQL injection
        $validLocales = ['en', 'az', 'ru'];
        if (!in_array($locale, $validLocales)) {
            $locale = 'en';
            $nameColumn = "name_en";
            $descriptionColumn = "description_en";
        }

        return $query->where(function ($q) use ($search, $nameColumn, $descriptionColumn) {
            $q->where($nameColumn, 'like', "%{$search}%")
                ->orWhere($descriptionColumn, 'like', "%{$search}%");
        });
    }
}
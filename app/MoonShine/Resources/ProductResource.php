<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;

use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Images;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Date;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<Product>
 */
class ProductResource extends ModelResource
{
    protected string $model = Product::class;

    protected string $title = 'Products';

    protected string $column = 'name_en';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Image::make('Cover', 'cover'),
            Text::make('Name', 'name_en')->sortable(),
            Text::make('Price Range', formatted: function ($item) {
                $sizes = $item->sizes()->withPivot(['price', 'is_active'])->get();
                if ($sizes->isEmpty()) {
                    return 'No sizes';
                }
                $prices = $sizes->pluck('pivot.price')->filter();
                if ($prices->isEmpty()) {
                    return 'No prices';
                }
                $min = $prices->min();
                $max = $prices->max();
                return $min == $max ? "$" . number_format($min, 2) : "$" . number_format($min, 2) . " - $" . number_format($max, 2);
            })->sortable(),
            Switcher::make('Active', 'is_active')->sortable(),
            Date::make('Created at', 'created_at')->format("d.m.Y")->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        $isCreating = $this->getItem() === null;

        return [
            Grid::make([
                Column::make([
                    Box::make([
                        ID::make(),
                        Tabs::make([
                            Tab::make('EN', [
                                Text::make('Name (EN)', 'name_en')->reactive(),
                                Textarea::make('Description (EN)', 'description_en'),
                            ]),
                            Tab::make('AZ', [
                                Text::make('Name (AZ)', 'name_az'),
                                Textarea::make('Description (AZ)', 'description_az'),
                            ]),
                            Tab::make('RU', [
                                Text::make('Name (RU)', 'name_ru'),
                                Textarea::make('Description (RU)', 'description_ru'),
                            ]),
                        ]),
                    ])
                ])->columnSpan(8),

                Column::make([
                    Box::make([
                        Slug::make('Url', 'slug')->required()->live()->from('name_en'),
                        Image::make('Cover', 'cover')->required($isCreating),
                        Image::make('Gallery', 'gallery')->multiple(),
                        Switcher::make('Active', 'is_active')->default(true),
                    ])
                ])->columnSpan(4),
            ]),

            Grid::make([
                Column::make([
                    Box::make([
                        BelongsToMany::make('Categories', 'categories', resource: CategoryResource::class)
                            ->searchable()
                            ->required(),
                    ])
                ])->columnSpan(4),

                Column::make([
                    Box::make([
                        BelongsToMany::make('Colors', 'colors', resource: ColorResource::class)
                            ->searchable(),
                    ])
                ])->columnSpan(4),

                Column::make([
                    Box::make([
                        BelongsToMany::make('Sizes', 'sizes', resource: SizeResource::class)
                            ->searchable()
                            ->fields([
                                Number::make('Price ($)', 'price')->required()->min(0)->step(0.01),
                                Switcher::make('Active', 'is_active')->default(true),
                            ]),
                    ])
                ])->columnSpan(4),
            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Name (EN)', 'name_en'),
            Text::make('Name (AZ)', 'name_az'),
            Text::make('Name (RU)', 'name_ru'),
            Textarea::make('Description (EN)', 'description_en'),
            Textarea::make('Description (AZ)', 'description_az'),
            Textarea::make('Description (RU)', 'description_ru'),
            Text::make('Url', 'slug', formatted: static fn(Model $model) => "/{$model->slug}"),
            Image::make('Cover', 'cover'),
            Image::make('Gallery', 'gallery')->multiple(),
            Text::make('Price Range', formatted: function ($item) {
                $sizes = $item->sizes()->withPivot(['price', 'is_active'])->get();
                if ($sizes->isEmpty()) {
                    return 'No sizes';
                }
                $prices = $sizes->pluck('pivot.price')->filter();
                if ($prices->isEmpty()) {
                    return 'No prices';
                }
                $min = $prices->min();
                $max = $prices->max();
                return $min == $max ? "$" . number_format($min, 2) : "$" . number_format($min, 2) . " - $" . number_format($max, 2);
            }),
            BelongsToMany::make('Categories', 'categories', resource: CategoryResource::class),
            BelongsToMany::make('Colors', 'colors', resource: ColorResource::class),
            BelongsToMany::make('Sizes with Prices', 'sizes', resource: SizeResource::class)
                ->fields([
                    Number::make('Price ($)', 'price'),
                    Switcher::make('Active', 'is_active'),
                ]),
            Switcher::make('Active', 'is_active'),
            Date::make('Created at', 'created_at')->format("d.m.Y"),
        ];
    }

    /**
     * @param Product $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        $isCreating = $item->getKey() === null;

        return [
            'name_en' => ['required', 'string', 'max:255'],
            'name_az' => ['required', 'string', 'max:255'],
            'name_ru' => ['required', 'string', 'max:255'],
            'description_en' => ['required', 'string'],
            'description_az' => ['required', 'string'],
            'description_ru' => ['required', 'string'],
            'slug' => ['required', 'string', 'max:255', 'unique:products,slug,' . $item->getKey()],
            'cover' => $isCreating ? ['required', 'image', 'max:8192'] : ['nullable', 'image', 'max:8192'],
            'gallery.*' => ['nullable', 'image', 'max:8192'],
            'is_active' => ['required', 'boolean'],
        ];
    }

    public function search(): array
    {
        return [
            'id',
            'name_en',
            'name_az',
            'slug',
        ];
    }
}
<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductPage;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Switcher;
use MoonShine\EasyMde\Fields\Markdown;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<ProductPage>
 */
class ProductPageResource extends ModelResource
{
    protected string $model = ProductPage::class;
    protected string $title = 'Product Page';
    protected bool $withPolicy = true;
    protected bool $createInModal = false;
    protected bool $editInModal = false;
    protected bool $showInModal = false;
    protected bool $deleteInModal = false;
    protected bool $forceDeleteInModal = false;
    protected bool $restoreInModal = false;
    protected bool $massDelete = false;
    protected bool $showDeleted = false;
    protected bool $showRestore = false;
    protected bool $showForceDelete = false;
    protected bool $showCreate = false;
    protected bool $showDelete = false;
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Title (EN)', 'title_en')->sortable(),
            Switcher::make('Active', 'is_active')->sortable(),
        ];
    }
    protected function formFields(): iterable
    {
        return [
            Grid::make([
                Column::make([
                    Box::make([
                        ID::make(),
                        Tabs::make([
                            Tab::make('EN', [
                                Text::make('Title (EN)', 'title_en'),
                                Markdown::make('Description (EN)', 'description_en'),
                                Text::make('Meta Title (EN)', 'meta_title_en'),
                                Textarea::make('Meta Description (EN)', 'meta_description_en'),
                                Textarea::make('Meta Keywords (EN)', 'meta_keywords_en'),
                                Text::make('OG Title (EN)', 'og_title_en'),
                                Textarea::make('OG Description (EN)', 'og_description_en'),
                            ]),
                            Tab::make('AZ', [
                                Text::make('Title (AZ)', 'title_az'),
                                Markdown::make('Description (AZ)', 'description_az'),
                                Text::make('Meta Title (AZ)', 'meta_title_az'),
                                Textarea::make('Meta Description (AZ)', 'meta_description_az'),
                                Textarea::make('Meta Keywords (AZ)', 'meta_keywords_az'),
                                Text::make('OG Title (AZ)', 'og_title_az'),
                                Textarea::make('OG Description (AZ)', 'og_description_az'),
                            ]),
                        ]),
                    ])
                ])->columnSpan(8),
                Column::make([
                    Box::make([
                        Image::make('OG Image', 'og_image')
                            ->disk('public')
                            ->dir('product-pages'),
                        Switcher::make('Active', 'is_active')->default(true),
                    ])
                ])->columnSpan(4),
            ])
        ];
    }
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Title (EN)', 'title_en'),
            Text::make('Title (AZ)', 'title_az'),
            Markdown::make('Description (EN)', 'description_en'),
            Markdown::make('Description (AZ)', 'description_az'),
            Text::make('Meta Title (EN)', 'meta_title_en'),
            Text::make('Meta Title (AZ)', 'meta_title_az'),
            Textarea::make('Meta Description (EN)', 'meta_description_en'),
            Textarea::make('Meta Description (AZ)', 'meta_description_az'),
            Textarea::make('Meta Keywords (EN)', 'meta_keywords_en'),
            Textarea::make('Meta Keywords (AZ)', 'meta_keywords_az'),
            Text::make('OG Title (EN)', 'og_title_en'),
            Text::make('OG Title (AZ)', 'og_title_az'),
            Textarea::make('OG Description (EN)', 'og_description_en'),
            Textarea::make('OG Description (AZ)', 'og_description_az'),
            Image::make('OG Image', 'og_image'),
            Switcher::make('Active', 'is_active'),
        ];
    }
    protected function rules(mixed $item): array
    {
        return [
            'title_en' => ['nullable', 'string', 'max:255'],
            'title_az' => ['nullable', 'string', 'max:255'],
            'description_en' => ['nullable', 'string'],
            'description_az' => ['nullable', 'string'],
            'meta_title_en' => ['nullable', 'string', 'max:255'],
            'meta_title_az' => ['nullable', 'string', 'max:255'],
            'meta_description_en' => ['nullable', 'string', 'max:500'],
            'meta_description_az' => ['nullable', 'string', 'max:500'],
            'meta_keywords_en' => ['nullable', 'string', 'max:500'],
            'meta_keywords_az' => ['nullable', 'string', 'max:500'],
            'og_title_en' => ['nullable', 'string', 'max:255'],
            'og_title_az' => ['nullable', 'string', 'max:255'],
            'og_description_en' => ['nullable', 'string', 'max:500'],
            'og_description_az' => ['nullable', 'string', 'max:500'],
            'og_image' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['boolean'],
        ];
    }
}
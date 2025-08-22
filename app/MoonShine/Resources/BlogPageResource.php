<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\BlogPage;

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
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<BlogPage>
 */
class BlogPageResource extends ModelResource
{
    protected string $model = BlogPage::class;

    protected string $title = 'Blog Page';

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

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Title (EN)', 'title_en')->sortable(),
            Switcher::make('Active', 'is_active')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
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
                                Textarea::make('Description (EN)', 'description_en'),
                                Text::make('Meta Title (EN)', 'meta_title_en'),
                                Textarea::make('Meta Description (EN)', 'meta_description_en'),
                                Textarea::make('Meta Keywords (EN)', 'meta_keywords_en'),
                                Text::make('OG Title (EN)', 'og_title_en'),
                                Textarea::make('OG Description (EN)', 'og_description_en'),
                            ]),
                            Tab::make('AZ', [
                                Text::make('Title (AZ)', 'title_az'),
                                Textarea::make('Description (AZ)', 'description_az'),
                                Text::make('Meta Title (AZ)', 'meta_title_az'),
                                Textarea::make('Meta Description (AZ)', 'meta_description_az'),
                                Textarea::make('Meta Keywords (AZ)', 'meta_keywords_az'),
                                Text::make('OG Title (AZ)', 'og_title_az'),
                                Textarea::make('OG Description (AZ)', 'og_description_az'),
                            ]),
                            Tab::make('RU', [
                                Text::make('Title (RU)', 'title_ru'),
                                Textarea::make('Description (RU)', 'description_ru'),
                                Text::make('Meta Title (RU)', 'meta_title_ru'),
                                Textarea::make('Meta Description (RU)', 'meta_description_ru'),
                                Textarea::make('Meta Keywords (RU)', 'meta_keywords_ru'),
                                Text::make('OG Title (RU)', 'og_title_ru'),
                                Textarea::make('OG Description (RU)', 'og_description_ru'),
                            ]),
                        ]),
                    ])
                ])->columnSpan(8),

                Column::make([
                    Box::make([
                        Image::make('OG Image', 'og_image')
                            ->disk('public')
                            ->dir('blog-pages'),
                        Switcher::make('Active', 'is_active')->default(true),
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
            Text::make('Title (EN)', 'title_en'),
            Text::make('Title (AZ)', 'title_az'),
            Text::make('Title (RU)', 'title_ru'),
            Textarea::make('Description (EN)', 'description_en'),
            Textarea::make('Description (AZ)', 'description_az'),
            Textarea::make('Description (RU)', 'description_ru'),
            Text::make('Meta Title (EN)', 'meta_title_en'),
            Text::make('Meta Title (AZ)', 'meta_title_az'),
            Text::make('Meta Title (RU)', 'meta_title_ru'),
            Textarea::make('Meta Description (EN)', 'meta_description_en'),
            Textarea::make('Meta Description (AZ)', 'meta_description_az'),
            Textarea::make('Meta Description (RU)', 'meta_description_ru'),
            Textarea::make('Meta Keywords (EN)', 'meta_keywords_en'),
            Textarea::make('Meta Keywords (AZ)', 'meta_keywords_az'),
            Textarea::make('Meta Keywords (RU)', 'meta_keywords_ru'),
            Text::make('OG Title (EN)', 'og_title_en'),
            Text::make('OG Title (AZ)', 'og_title_az'),
            Text::make('OG Title (RU)', 'og_title_ru'),
            Textarea::make('OG Description (EN)', 'og_description_en'),
            Textarea::make('OG Description (AZ)', 'og_description_az'),
            Textarea::make('OG Description (RU)', 'og_description_ru'),
            Image::make('OG Image', 'og_image'),
            Switcher::make('Active', 'is_active'),
        ];
    }

    /**
     * @param BlogPage $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'title_en' => ['nullable', 'string', 'max:255'],
            'title_az' => ['nullable', 'string', 'max:255'],
            'title_ru' => ['nullable', 'string', 'max:255'],
            'description_en' => ['nullable', 'string'],
            'description_az' => ['nullable', 'string'],
            'description_ru' => ['nullable', 'string'],
            'meta_title_en' => ['nullable', 'string', 'max:255'],
            'meta_title_az' => ['nullable', 'string', 'max:255'],
            'meta_title_ru' => ['nullable', 'string', 'max:255'],
            'meta_description_en' => ['nullable', 'string', 'max:500'],
            'meta_description_az' => ['nullable', 'string', 'max:500'],
            'meta_description_ru' => ['nullable', 'string', 'max:500'],
            'meta_keywords_en' => ['nullable', 'string', 'max:500'],
            'meta_keywords_az' => ['nullable', 'string', 'max:500'],
            'meta_keywords_ru' => ['nullable', 'string', 'max:500'],
            'og_title_en' => ['nullable', 'string', 'max:255'],
            'og_title_az' => ['nullable', 'string', 'max:255'],
            'og_title_ru' => ['nullable', 'string', 'max:255'],
            'og_description_en' => ['nullable', 'string', 'max:500'],
            'og_description_az' => ['nullable', 'string', 'max:500'],
            'og_description_ru' => ['nullable', 'string', 'max:500'],
            'og_image' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['boolean'],
        ];
    }
}

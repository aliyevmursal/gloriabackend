<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\AboutPage;

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
 * @extends ModelResource<AboutPage>
 */
class AboutPageResource extends ModelResource
{
    protected string $model = AboutPage::class;

    protected string $title = 'About Page';

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
            Text::make('Video URL', 'video_url')->sortable(),
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
                                Markdown::make('Description (EN)', 'description_en'),
                                Text::make('Quality Title (EN)', 'quality_title_en'),
                                Textarea::make('Quality Description (EN)', 'quality_description_en'),
                                Text::make('Individual Approach Title (EN)', 'individual_approach_title_en'),
                                Textarea::make('Individual Approach Description (EN)', 'individual_approach_description_en'),
                                Text::make('Worldwide Shipping Title (EN)', 'worldwide_shipping_title_en'),
                                Textarea::make('Worldwide Shipping Description (EN)', 'worldwide_shipping_description_en'),
                                Text::make('Meta Title (EN)', 'meta_title_en'),
                                Textarea::make('Meta Description (EN)', 'meta_description_en'),
                                Textarea::make('Meta Keywords (EN)', 'meta_keywords_en'),
                                Text::make('OG Title (EN)', 'og_title_en'),
                                Textarea::make('OG Description (EN)', 'og_description_en'),
                            ]),

                            Tab::make('AZ', [
                                Markdown::make('Description (AZ)', 'description_az'),
                                Text::make('Quality Title (AZ)', 'quality_title_az'),
                                Textarea::make('Quality Description (AZ)', 'quality_description_az'),
                                Text::make('Individual Approach Title (AZ)', 'individual_approach_title_az'),
                                Textarea::make('Individual Approach Description (AZ)', 'individual_approach_description_az'),
                                Text::make('Worldwide Shipping Title (AZ)', 'worldwide_shipping_title_az'),
                                Textarea::make('Worldwide Shipping Description (AZ)', 'worldwide_shipping_description_az'),
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
                        Text::make('Video URL (Vimeo)', 'video_url'),
                        Image::make('OG Image', 'og_image')
                            ->disk('public')
                            ->dir('about-pages'),
                        Switcher::make('Active', 'is_active')->default(true),
                    ])
                ])->columnSpan(4),
            ])
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Markdown::make('Description (EN)', 'description_en'),
            Markdown::make('Description (AZ)', 'description_az'),
            Text::make('Video URL', 'video_url'),
            Text::make('Quality Title (EN)', 'quality_title_en'),
            Text::make('Quality Title (AZ)', 'quality_title_az'),
            Textarea::make('Quality Description (EN)', 'quality_description_en'),
            Textarea::make('Quality Description (AZ)', 'quality_description_az'),
            Text::make('Individual Approach Title (EN)', 'individual_approach_title_en'),
            Text::make('Individual Approach Title (AZ)', 'individual_approach_title_az'),
            Textarea::make('Individual Approach Description (EN)', 'individual_approach_description_en'),
            Textarea::make('Individual Approach Description (AZ)', 'individual_approach_description_az'),
            Text::make('Worldwide Shipping Title (EN)', 'worldwide_shipping_title_en'),
            Text::make('Worldwide Shipping Title (AZ)', 'worldwide_shipping_title_az'),
            Textarea::make('Worldwide Shipping Description (EN)', 'worldwide_shipping_description_en'),
            Textarea::make('Worldwide Shipping Description (AZ)', 'worldwide_shipping_description_az'),
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

    /**
     * @param AboutPage $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'description_en' => ['nullable', 'string'],
            'description_az' => ['nullable', 'string'],
            'video_url' => ['nullable', 'url', 'max:255'],
            'quality_title_en' => ['nullable', 'string', 'max:255'],
            'quality_title_az' => ['nullable', 'string', 'max:255'],
            'quality_description_en' => ['nullable', 'string'],
            'quality_description_az' => ['nullable', 'string'],
            'individual_approach_title_en' => ['nullable', 'string', 'max:255'],
            'individual_approach_title_az' => ['nullable', 'string', 'max:255'],
            'individual_approach_description_en' => ['nullable', 'string'],
            'individual_approach_description_az' => ['nullable', 'string'],
            'worldwide_shipping_title_en' => ['nullable', 'string', 'max:255'],
            'worldwide_shipping_title_az' => ['nullable', 'string', 'max:255'],
            'worldwide_shipping_description_en' => ['nullable', 'string'],
            'worldwide_shipping_description_az' => ['nullable', 'string'],
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
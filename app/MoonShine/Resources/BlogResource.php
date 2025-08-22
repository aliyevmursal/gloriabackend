<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog;

use MoonShine\EasyMde\Fields\Markdown;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\DateRange;
use MoonShine\UI\Fields\Field;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Date;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<Blog>
 */
class BlogResource extends ModelResource
{
    protected string $model = Blog::class;

    protected string $title = 'Blogs';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Image::make('Cover', 'cover'),
            Text::make('Name', 'name_en')->sortable(),
            BelongsTo::make('Category', 'category', resource: BlogCategoryResource::class),
            Number::make('View count', 'view_count')->sortable(),
            Switcher::make('Active', 'is_active'),
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
                                Markdown::make('Content (EN)', 'description_en'),
                                Text::make('Meta Title (EN)', 'meta_title_en'),
                                Text::make('Meta Description (EN)', 'meta_description_en'),
                                Text::make('Meta Keywords (EN)', 'meta_keywords_en'),
                                Text::make('OG Title (EN)', 'og_title_en'),
                                Text::make('OG Description (EN)', 'og_description_en'),
                            ]),

                            Tab::make('AZ', [
                                Text::make('Name (AZ)', 'name_az'),
                                Markdown::make('Content (AZ)', 'description_az'),
                                Text::make('Meta Title (AZ)', 'meta_title_az'),
                                Text::make('Meta Description (AZ)', 'meta_description_az'),
                                Text::make('Meta Keywords (AZ)', 'meta_keywords_az'),
                                Text::make('OG Title (AZ)', 'og_title_az'),
                                Text::make('OG Description (AZ)', 'og_description_az'),
                            ]),
                        ]),
                    ])
                ])->columnSpan(8),

                Column::make([
                    Box::make([
                        BelongsTo::make('Category', 'category', resource: BlogCategoryResource::class)
                            ->searchable()
                            ->nullable()
                            ->required(),
                        Slug::make('Url', 'slug')->required()->live()->from('name_en'),
                        Image::make('Cover', 'cover')->required($isCreating),
                        Image::make('OG Image', 'og_image')
                            ->disk('public')
                            ->dir('blogs'),
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
            BelongsTo::make('Category', 'category', resource: BlogCategoryResource::class),
            Text::make('Name (EN)', 'name_en'),
            Text::make('Name (AZ)', 'name_az'),
            Image::make('Cover', 'cover'),
            Text::make('Url', 'slug', formatted: static fn(Model $model) => "/{$model->slug}"),
            Number::make("View count", "view_count"),
            Markdown::make('Content (EN)', 'description_en'),
            Markdown::make('Content (AZ)', 'description_az'),
            Text::make('Meta Title (EN)', 'meta_title_en'),
            Text::make('Meta Title (AZ)', 'meta_title_az'),
            Text::make('Meta Description (EN)', 'meta_description_en'),
            Text::make('Meta Description (AZ)', 'meta_description_az'),
            Text::make('Meta Keywords (EN)', 'meta_keywords_en'),
            Text::make('Meta Keywords (AZ)', 'meta_keywords_az'),
            Text::make('OG Title (EN)', 'og_title_en'),
            Text::make('OG Title (AZ)', 'og_title_az'),
            Text::make('OG Description (EN)', 'og_description_en'),
            Text::make('OG Description (AZ)', 'og_description_az'),
            Image::make('OG Image', 'og_image'),
        ];
    }

    /**
     * @param Blog $item
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
            'slug' => ['required', 'string', 'max:255', 'unique:blogs,slug,' . $item->getKey()],
            'blog_category_id' => ['required', 'exists:blog_categories,id'],
            'cover' => $isCreating ? ['required', 'image', 'max:8192'] : ['nullable', 'image', 'max:8192'],
            'is_active' => ['required', 'boolean'],
            'description_en' => ['required', 'string'],
            'description_az' => ['required', 'string'],
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
        ];
    }

    public function filters(): array|\Traversable
    {
        return [
            Text::make('Name', 'name_en'),
            BelongsTo::make('Category', 'category', resource: BlogCategoryResource::class)->nullable()->searchable(),
            DateRange::make('Created at', 'created_at'),
        ];
    }

    public function search(): array
    {
        return [
            'id',
            'name_en',
            'name_az',
            'slug',
            'category.name_en',
            'category.name_az',
        ];
    }
}

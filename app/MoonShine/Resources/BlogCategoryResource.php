<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\BlogCategory;

use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Layout\Column;

/**
 * @extends ModelResource<BlogCategory>
 */
class BlogCategoryResource extends ModelResource
{
    protected string $model = BlogCategory::class;

    protected string $title = 'Categories';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = true;

    protected string $column = 'name_en';


    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Name', 'name_en')->sortable(),
            Text::make('Url', 'slug', formatted: static fn(Model $model) => "/{$model->slug}")->sortable(),
            Switcher::make("Active", "is_active"),
            Date::make('Created at', 'created_at')->format("d.m.Y")->sortable(),
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
                                Text::make('Name (EN)', 'name_en')->reactive()->required(),
                            ]),
                            Tab::make('AZ', [
                                Text::make('Name (AZ)', 'name_az')->required(),
                            ]),
                            Tab::make('RU', [
                                Text::make('Name (RU)', 'name_ru')->required(),
                            ]),
                        ]),
                        Slug::make('Url', 'slug')->required()->live()->from('name_en'),
                        Switcher::make('Active', 'is_active')->default(true),
                    ])
                ])->columnSpan(8),
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
            Text::make('Url', 'slug', formatted: static fn(Model $model) => "/{$model->slug}"),
            Switcher::make('Active', 'is_active'),
            Date::make('Created at', 'created_at')->format("d.m.Y"),
        ];
    }

    /**
     * @param BlogCategory $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'name_en' => ['required', 'string', 'max:255'],
            'name_az' => ['required', 'string', 'max:255'],
            'name_ru' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:blog_categories,slug,' . $item->getKey()],
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

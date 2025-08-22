<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Banner;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Components\Url;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Number;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<Banner>
 */
class BannerResource extends ModelResource
{
    protected string $model = Banner::class;

    protected string $title = 'Banners';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Title', 'title_en')->sortable(),
            Image::make('Cover', 'cover'),
            Switcher::make('Active', 'is_active')->sortable(),
            Number::make('Position', 'position')->sortable(),
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
                                Text::make('Title (EN)', 'title_en'),
                                Text::make('Slogan (EN)', 'slogan_en'),
                                Text::make('Description (EN)', 'helper_text_en'),
                            ]),
                            Tab::make('AZ', [
                                Text::make('Title (AZ)', 'title_az'),
                                Text::make('Slogan (AZ)', 'slogan_az'),
                                Text::make('Description (AZ)', 'helper_text_az'),
                            ]),
                        ])
                    ])
                ])->columnSpan(8),

                Column::make([
                    Box::make([
                        Image::make('Cover', 'cover')->required($isCreating),
                        Switcher::make('Active', 'is_active')->default(true),
                        Number::make('Position', 'position')->default(0),
                        Text::make('Link', 'link')
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
            Text::make('Title (EN)', 'title_en')->sortable(),
            Text::make('Title (AZ)', 'title_en')->sortable(),
            Image::make('Cover', 'cover'),
            Switcher::make('Active', 'is_active')->sortable(),
            Number::make('Position', 'position')->sortable(),
            Text::make('Slogan (EN)', 'slogan_en')->sortable(),
            Text::make('Slogan (AZ)', 'slogan_az')->sortable(),
            Text::make('Description (EN)', 'helper_text_en')->sortable(),
            Text::make('Description (AZ)', 'helper_text_az')->sortable(),
            Text::make('Link', 'link'),
            Date::make('Created at', 'created_at')->format("d.m.Y")->sortable(),
        ];
    }

    public function search(): array
    {
        return [
            'id',
            'title_en',
            'title_az',
        ];
    }

    /**
     * @param Banner $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        $isCreating = $item->getKey() === null;

        return [
            'title_en' => ['required', 'string', 'max:255'],
            'title_az' => ['required', 'string', 'max:255'],
            'position' => ['required', 'numeric', 'min:0'],
            'is_active' => ['required', 'boolean'],
            'slogan_az' => ['nullable', 'string', 'max:255'],
            'slogan_en' => ['nullable', 'string', 'max:255'],
            'helper_text_az' => ['nullable', 'string', 'max:255'],
            'helper_text_en' => ['nullable', 'string', 'max:255'],
            'link' => ['required', 'string', 'max:255'],
            'cover' => $isCreating ? ['required', 'image', 'max:8192'] : ['nullable', 'image', 'max:8192'],
        ];
    }
}

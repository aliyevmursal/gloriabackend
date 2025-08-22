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
        return [
            Grid::make([
                Column::make([
                    Box::make([
                        ID::make(),
                        Tabs::make([
                            Tab::make('EN', [
                                Text::make('Title (EN)', 'title_en')->reactive(),
                                Text::make('Slogan (EN)', 'slogan_en'),
                                Text::make('Helper Text (EN)', 'helper_text_en'),
                            ]),
                            Tab::make('AZ', [
                                Text::make('Title (AZ)', 'title_az'),
                                Text::make('Slogan (AZ)', 'slogan_az'),
                                Text::make('Helper Text (AZ)', 'helper_text_az'),
                            ]),
                            Tab::make('RU', [
                                Text::make('Title (RU)', 'title_ru'),
                                Text::make('Slogan (RU)', 'slogan_ru'),
                                Text::make('Helper Text (RU)', 'helper_text_ru'),
                            ]),
                        ]),
                    ])
                ])->columnSpan(8),

                Column::make([
                    Box::make([
                        Image::make('Cover', 'cover')->required(),
                        Text::make('Link', 'link')->hint('Optional link for banner'),
                        Number::make('Position', 'position')->default(0)->min(0),
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
            Image::make('Cover', 'cover'),
            Text::make('Title (EN)', 'title_en'),
            Text::make('Title (AZ)', 'title_az'),
            Text::make('Title (RU)', 'title_ru'),
            Text::make('Slogan (EN)', 'slogan_en'),
            Text::make('Slogan (AZ)', 'slogan_az'),
            Text::make('Slogan (RU)', 'slogan_ru'),
            Text::make('Helper Text (EN)', 'helper_text_en'),
            Text::make('Helper Text (AZ)', 'helper_text_az'),
            Text::make('Helper Text (RU)', 'helper_text_ru'),
            Text::make('Link', 'link'),
            Number::make('Position', 'position'),
            Switcher::make('Active', 'is_active'),
            Date::make('Created at', 'created_at')->format("d.m.Y"),
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
        return [
            'title_en' => ['nullable', 'string', 'max:255'],
            'title_az' => ['nullable', 'string', 'max:255'],
            'title_ru' => ['nullable', 'string', 'max:255'],
            'slogan_en' => ['nullable', 'string', 'max:255'],
            'slogan_az' => ['nullable', 'string', 'max:255'],
            'slogan_ru' => ['nullable', 'string', 'max:255'],
            'helper_text_en' => ['nullable', 'string', 'max:255'],
            'helper_text_az' => ['nullable', 'string', 'max:255'],
            'helper_text_ru' => ['nullable', 'string', 'max:255'],
            'cover' => ['nullable', 'image', 'max:2048'],
            'link' => ['nullable', 'url', 'max:255'],
            'position' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }
}

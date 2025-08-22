<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\DeliveryType;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Date;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<DeliveryType>
 */
class DeliveryTypeResource extends ModelResource
{
    protected string $model = DeliveryType::class;

    protected string $title = 'Delivery Types';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = true;

    protected string $column = 'title_en';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Title', 'title_en')->sortable(),
            Number::make('Price ($)', 'price')->sortable(),
            Switcher::make("Active", "is_active")->sortable(),
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
                                Text::make('Title (EN)', 'title_en')->required(),
                            ]),
                            Tab::make('AZ', [
                                Text::make('Title (AZ)', 'title_az')->required(),
                            ]),
                        ]),
                        Number::make('Price ($)', 'price')->required()->min(0)->step(0.01),
                    ])
                ])->columnSpan(8),
                Column::make([
                    Box::make([
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
            Number::make('Price ($)', 'price'),
            Switcher::make('Active', 'is_active'),
            Date::make('Created at', 'created_at')->format("d.m.Y"),
        ];
    }

    /**
     * @param DeliveryType $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'title_en' => ['required', 'string', 'max:255'],
            'title_az' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'is_active' => ['required', 'boolean'],
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
}

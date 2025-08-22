<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Note;
use App\Models\Product;

use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Date;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<Note>
 */
class NoteResource extends ModelResource
{
    protected string $model = Note::class;

    protected string $title = 'Notes';

    protected string $column = 'title_en';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Title (EN)', 'title_en')->sortable(),
            Text::make('Title (AZ)', 'title_az')->sortable(),
            Text::make('Title (RU)', 'title_ru')->sortable(),
            Switcher::make('Active', 'is_active')->sortable(),
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
                                Text::make('Title (EN)', 'title_en')->required()->reactive(),
                            ]),
                            Tab::make('AZ', [
                                Text::make('Title (AZ)', 'title_az')->required(),
                            ]),
                            Tab::make('RU', [
                                Text::make('Title (RU)', 'title_ru')->required(),
                            ]),
                        ]),
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
            Text::make('Title (EN)', 'title_en'),
            Text::make('Title (AZ)', 'title_az'),
            Text::make('Title (RU)', 'title_ru'),
            Switcher::make('Active', 'is_active'),
            Date::make('Created at', 'created_at')->format("d.m.Y"),
            Date::make('Updated at', 'updated_at')->format("d.m.Y"),
        ];
    }

    /**
     * @param Note $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'title_en' => ['required', 'string', 'max:255'],
            'title_az' => ['required', 'string', 'max:255'],
            'title_ru' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
        ];
    }

    public function search(): array
    {
        return [
            'id',
            'title_en',
            'title_az',
            'title_ru',
        ];
    }
}

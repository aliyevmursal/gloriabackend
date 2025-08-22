<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Faq;

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
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Date;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<Faq>
 */
class FaqResource extends ModelResource
{
    protected string $model = Faq::class;

    protected string $title = 'FAQs';

    protected string $column = 'question_en';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Question', 'question_en')->sortable(),
            Switcher::make("Active", "is_active")->sortable(),
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
                                Text::make('Question (EN)', 'question_en')->reactive()->required(),
                                Textarea::make('Answer (EN)', 'answer_en')->required(),
                            ]),
                            Tab::make('AZ', [
                                Text::make('Question (AZ)', 'question_az')->required(),
                                Textarea::make('Answer (AZ)', 'answer_az')->required(),
                            ]),
                            Tab::make('RU', [
                                Text::make('Question (RU)', 'question_ru')->required(),
                                Textarea::make('Answer (RU)', 'answer_ru')->required(),
                            ]),
                        ]),
                    ])
                ])->columnSpan(8),

                Column::make([
                    Box::make([
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
            Text::make('Question (EN)', 'question_en'),
            Text::make('Question (AZ)', 'question_az'),
            Text::make('Question (RU)', 'question_ru'),
            Textarea::make('Answer (EN)', 'answer_en'),
            Textarea::make('Answer (AZ)', 'answer_az'),
            Textarea::make('Answer (RU)', 'answer_ru'),
            Number::make('Position', 'position'),
            Switcher::make('Active', 'is_active'),
            Date::make('Created at', 'created_at')->format("d.m.Y"),
        ];
    }

    /**
     * @param Faq $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'question_en' => ['required', 'string', 'max:255'],
            'question_az' => ['required', 'string', 'max:255'],
            'question_ru' => ['required', 'string', 'max:255'],
            'answer_en' => ['required', 'string'],
            'answer_az' => ['required', 'string'],
            'answer_ru' => ['required', 'string'],
            'position' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }

    public function search(): array
    {
        return [
            'id',
            'question_en',
            'question_az',
            'answer_en',
            'answer_az',
        ];
    }
}
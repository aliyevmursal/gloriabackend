<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contact;
use App\Policies\ContactPolicy;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\DateRange;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<Contact>
 */
class ContactResource extends ModelResource
{
    protected string $model = Contact::class;

    protected string $title = 'Contact Messages';

    protected string $column = 'name';

    protected bool $withPolicy = true;

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Name', 'name')->sortable(),
            Email::make('Email', 'email')->sortable(),
            Text::make('Subject', 'subject')->sortable(),
            Switcher::make("Read", "is_read")->sortable(),
            Date::make('Created at', 'created_at')->format("d.m.Y H:i")->sortable(),
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
                        Text::make('Name', 'name')->required(),
                        Email::make('Email', 'email')->required(),
                        Text::make('Subject', 'subject')->required(),
                        Textarea::make('Message', 'message')->required(),
                        Switcher::make('Is Read', 'is_read')->default(false),
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
            Text::make('Name', 'name'),
            Email::make('Email', 'email'),
            Text::make('Subject', 'subject'),
            Textarea::make('Message', 'message'),
            Switcher::make('Is Read', 'is_read'),
            Date::make('Created at', 'created_at')->format("d.m.Y H:i"),
        ];
    }

    /**
     * @param Contact $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'is_read' => ['boolean'],
        ];
    }

    public function search(): array
    {
        return [
            'id',
            'name',
            'email',
            'subject',
            'message',
        ];
    }

    public function filters(): array
    {
        return [
            Text::make('Name', 'name'),
            Email::make('Email', 'email'),
            Text::make('Subject', 'subject'),
            Switcher::make('Read', 'is_read'),
            DateRange::make('Created at', 'created_at'),
        ];
    }
}
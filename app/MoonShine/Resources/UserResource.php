<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\Date;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<User>
 */
class UserResource extends ModelResource
{
    protected string $model = User::class;

    protected string $title = 'Users';

    protected string $column = 'first_name';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('First Name', 'first_name')->sortable(),
            Text::make('Last Name', 'last_name')->sortable(),
            Email::make('Email', 'email')->sortable(),
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
                        Text::make('First Name', 'first_name')->required(),
                        Text::make('Last Name', 'last_name')->required(),
                        Email::make('Email', 'email')->required(),
                    ])
                ])->columnSpan(8),

                Column::make([
                    Box::make([
                        Password::make('Password', 'password')
                            ->required($isCreating)
                            ->hint($isCreating ? 'Required for new users' : 'Leave empty to keep current password'),
                        Date::make('Created at', 'created_at')->format("d.m.Y H:i")->readonly(),
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
            Text::make('First Name', 'first_name'),
            Text::make('Last Name', 'last_name'),
            Email::make('Email', 'email'),
            Date::make('Created at', 'created_at')->format("d.m.Y H:i"),
            Date::make('Updated at', 'updated_at')->format("d.m.Y H:i"),
        ];
    }

    /**
     * @param User $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        $isCreating = $item->getKey() === null;

        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $item->getKey()],
            'password' => $isCreating
                ? ['required', 'string', 'min:8']
                : ['nullable', 'string', 'min:8'],
        ];
    }

    public function search(): array
    {
        return [
            'id',
            'first_name',
            'last_name',
            'email',
            'phone_number',
        ];
    }
}
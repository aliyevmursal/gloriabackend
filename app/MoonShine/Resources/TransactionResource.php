<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Toggle;
use MoonShine\UI\Fields\Date;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<Transaction>
 */
class TransactionResource extends ModelResource
{
    protected string $model = Transaction::class;

    protected string $title = 'Transactions';

    protected string $column = 'txpg_id';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Transaction PG ID', 'txpg_id')->sortable(),
            Text::make('Status', 'status')->sortable(),
            Text::make('HPP URL', 'hpp_url'),
            Text::make('CVV 2 Auth', 'cvv_2_auth_status'),
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
                        Text::make('Transaction PG ID', 'txpg_id')
                            ->required(),
                        Select::make('Status', 'status')
                            ->options([
                                'pending' => 'Pending',
                                'success' => 'Success',
                                'failed' => 'Failed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required(),
                        Text::make('CVV 2 Authentication Status', 'cvv_2_auth_status'),
                    ])
                ])->columnSpan(8),

                Column::make([
                    Box::make([
                        Text::make('Password', 'password'),
                        Text::make('Secret', 'secret'),
                    ])
                ])->columnSpan(4),
            ]),

            Box::make([
                Text::make('HPP URL', 'hpp_url'),
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
            Text::make('Transaction PG ID', 'txpg_id'),
            Text::make('Status', 'status'),
            Text::make('HPP URL', 'hpp_url'),
            Text::make('Password', 'password'),
            Text::make('Secret', 'secret'),
            Text::make('CVV 2 Authentication Status', 'cvv_2_auth_status'),
            Date::make('Created at', 'created_at')->format("d.m.Y H:i"),
            Date::make('Updated at', 'updated_at')->format("d.m.Y H:i"),
        ];
    }

    /**
     * @param Transaction $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'txpg_id' => ['required', 'string', 'max:255', 'unique:transactions,txpg_id,' . $item?->id],
            'hpp_url' => ['nullable', 'string', 'max:1000'],
            'password' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'secret' => ['nullable', 'string', 'max:1000'],
            'cvv_2_auth_status' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function search(): array
    {
        return [
            'id',
            'txpg_id',
            'status',
            'hpp_url',
        ];
    }
}

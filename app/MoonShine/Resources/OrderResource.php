<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Date;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use App\MoonShine\Resources\DeliveryTypeResource;

/**
 * @extends ModelResource<Order>
 */
class OrderResource extends ModelResource
{
    protected string $model = Order::class;

    protected string $title = 'Orders';

    protected string $column = 'id';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('User', 'user', resource: UserResource::class),
            Number::make('Total Price ($)', 'total_price')->sortable(),
            Text::make('Phone', 'phone_number'),
            Text::make('Country', 'country'),
            BelongsTo::make('Delivery Type', 'deliveryType', resource: DeliveryTypeResource::class),
            Select::make('Is Paid', 'is_paid')->options([
                true => 'Yes',
                false => 'No'
            ])->sortable(),
            Select::make('Status', 'status')->options([
                'pending' => 'Pending',
                'confirmed' => 'Confirmed',
                'preparing' => 'Preparing',
                'prepared' => 'Prepared',
                'shipped' => 'Shipped',
                'delivered' => 'Delivered',
                'returned' => 'Returned',
                'cancelled' => 'Cancelled',
            ])->sortable(),
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
                        BelongsTo::make('User', 'user', resource: UserResource::class)
                            ->searchable()
                            ->required(),
                        Number::make('Total Price ($)', 'total_price')
                            ->required()
                            ->min(0)
                            ->step(0.01),
                    ])
                ])->columnSpan(8),

                Column::make([
                    Box::make([
                        Select::make('Status', 'status')
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'preparing' => 'Preparing',
                                'prepared' => 'Prepared',
                                'shipped' => 'Shipped',
                                'delivered' => 'Delivered',
                                'returned' => 'Returned',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required(),
                        BelongsTo::make('Delivery Type', 'deliveryType', resource: DeliveryTypeResource::class)
                            ->searchable(),
                        Select::make('Is Paid', 'is_paid')->options([
                            true => 'Yes',
                            false => 'No'
                        ])->required(),
                        Text::make('Phone Number', 'phone_number')->required(),
                        Text::make('ZIP Code', 'zip_code')->required(),
                        Text::make('Country', 'country')->required(),
                    ])
                ])->columnSpan(4),
            ]),

            Box::make([
                Textarea::make('Address', 'address')->required(),
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
            BelongsTo::make('User', 'user', resource: UserResource::class),
            Number::make('Total Price ($)', 'total_price'),
            BelongsTo::make('Delivery Type', 'deliveryType', resource: DeliveryTypeResource::class),
            Select::make('Is Paid', 'is_paid')->options([
                true => 'Yes',
                false => 'No'
            ]),
            Text::make('Phone Number', 'phone_number'),
            Text::make('ZIP Code', 'zip_code'),
            Text::make('Country', 'country'),
            Textarea::make('Address', 'address'),
            Select::make('Status', 'status')->options([
                'pending' => 'Pending',
                'confirmed' => 'Confirmed',
                'preparing' => 'Preparing',
                'prepared' => 'Prepared',
                'shipped' => 'Shipped',
                'delivered' => 'Delivered',
                'returned' => 'Returned',
                'cancelled' => 'Cancelled',
            ]),
            Date::make('Created at', 'created_at')->format("d.m.Y H:i"),
            Date::make('Updated at', 'updated_at')->format("d.m.Y H:i"),
        ];
    }

    /**
     * @param Order $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'total_price' => ['required', 'numeric', 'min:0'],
            'delivery_type_id' => ['nullable', 'exists:delivery_types,id'],
            'is_paid' => ['required', 'boolean'],
            'phone_number' => ['required', 'string', 'max:20'],
            'zip_code' => ['required', 'string', 'max:10'],
            'country' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:500'],
            'status' => ['required', 'in:pending,confirmed,preparing,prepared,shipped,delivered,returned,cancelled'],
        ];
    }

    public function search(): array
    {
        return [
            'id',
            'phone_number',
            'country',
            'user.first_name',
            'user.last_name',
            'user.email',
        ];
    }
}
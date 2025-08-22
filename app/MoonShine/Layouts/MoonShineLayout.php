<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use App\MoonShine\Resources\DeliveryTypeResource;
use App\MoonShine\Resources\DiscountResource;
use App\MoonShine\Resources\OrderResource;
use App\MoonShine\Resources\ProductResource;
use App\MoonShine\Resources\TransactionResource;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\UI\Components\Layout\Layout;
use MoonShine\MenuManager\MenuGroup;
use App\MoonShine\Resources\CategoryResource;
use MoonShine\MenuManager\MenuItem;
use App\MoonShine\Resources\BlogCategoryResource;
use App\MoonShine\Resources\BlogResource;
use App\MoonShine\Resources\BannerResource;
use App\MoonShine\Resources\ColorResource;
use App\MoonShine\Resources\SizeResource;
use App\MoonShine\Resources\FaqResource;
use App\MoonShine\Resources\ContactResource;
use App\MoonShine\Resources\UserResource;
use App\MoonShine\Resources\BlogPageResource;
use App\MoonShine\Resources\ContactPageResource;
use App\MoonShine\Resources\AboutPageResource;
use App\MoonShine\Resources\HomePageResource;
use App\MoonShine\Resources\ProductPageResource;
use App\MoonShine\Resources\NoteResource;

final class MoonShineLayout extends AppLayout
{
    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    protected function menu(): array
    {
        return [
            // ...parent::menu(),
            MenuItem::make('Statistics', asset('/admin'))->icon('chart-bar-square'),

            MenuItem::make('Banner', BannerResource::class)->icon('photo'),

            MenuGroup::make('Blog', [
                MenuItem::make('Categories', BlogCategoryResource::class),
                MenuItem::make('Blogs', BlogResource::class),
            ])->icon('newspaper'),

            MenuGroup::make('Store', [
                MenuItem::make('Categories', CategoryResource::class),
                MenuItem::make('Colors', ColorResource::class),
                MenuItem::make('Sizes', SizeResource::class),
                MenuItem::make('Products', ProductResource::class),
                MenuItem::make('Discounts', DiscountResource::class),
                MenuItem::make('Notes', NoteResource::class),
            ])->icon('building-storefront'),

            MenuGroup::make('Order', [
                MenuItem::make('Delivery Types', DeliveryTypeResource::class),
                MenuItem::make('Orders', OrderResource::class),
                MenuItem::make('Transactions', TransactionResource::class),
            ])->icon('shopping-bag'),

            MenuGroup::make('Help', [
                MenuItem::make('FAQs', FaqResource::class),
                MenuItem::make('Contact Messages', ContactResource::class),
            ])->icon('question-mark-circle'),

            MenuItem::make('Users', UserResource::class)->icon('user'),

            MenuGroup::make('Static Pages', [
                MenuItem::make('Home Page', HomePageResource::class)->icon('home'),
                MenuItem::make('Product Page', ProductPageResource::class)->icon('tag'),
                MenuItem::make('Blog Page', BlogPageResource::class)->icon('paper-clip'),
                MenuItem::make('Contact Page', ContactPageResource::class)->icon('phone'),
                MenuItem::make('About Page', AboutPageResource::class)->icon('information-circle'),
            ])->icon('document-text'),
        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }

    public function build(): Layout
    {
        return parent::build();
    }

    protected function getFooterCopyright(): string
    {
        return '';
    }

    protected function getFooterMenu(): array
    {
        return [];
    }
}

<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\TransactionResource;
use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\BlogCategoryResource;
use App\MoonShine\Resources\BlogResource;
use App\MoonShine\Resources\BannerResource;
use App\MoonShine\Resources\ColorResource;
use App\MoonShine\Resources\SizeResource;
use App\MoonShine\Resources\DeliveryTypeResource;
use App\MoonShine\Resources\FaqResource;
use App\MoonShine\Resources\ContactResource;
use App\MoonShine\Resources\ProductResource;
use App\MoonShine\Resources\DiscountResource;
use App\MoonShine\Resources\UserResource;
use App\MoonShine\Resources\OrderResource;
use App\MoonShine\Resources\BlogPageResource;
use App\MoonShine\Resources\ContactPageResource;
use App\MoonShine\Resources\AboutPageResource;
use App\MoonShine\Resources\HomePageResource;
use App\MoonShine\Resources\ProductPageResource;
use App\MoonShine\Resources\NoteResource;

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     *
     */
    public function boot(CoreContract $core, ConfiguratorContract $config): void
    {
        // $config->authEnable();

        $core
            ->resources([
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                CategoryResource::class,
                BlogCategoryResource::class,
                BlogResource::class,
                BannerResource::class,
                ColorResource::class,
                SizeResource::class,
                DeliveryTypeResource::class,
                FaqResource::class,
                ContactResource::class,
                ProductResource::class,
                DiscountResource::class,
                UserResource::class,
                OrderResource::class,
                BlogPageResource::class,
                ContactPageResource::class,
                AboutPageResource::class,
                HomePageResource::class,
                ProductPageResource::class,
                TransactionResource::class,
                NoteResource::class,
            ])
            ->pages([
                ...$config->getPages(),
            ])
        ;
    }
}

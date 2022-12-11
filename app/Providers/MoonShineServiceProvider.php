<?php

namespace App\Providers;

use App\MoonShine\Resources\BrandResource;
use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\OptionResource;
use App\MoonShine\Resources\ProductResource;
use App\MoonShine\Resources\PropertyResource;
use Illuminate\Support\ServiceProvider;
use Leeto\MoonShine\Menu\MenuGroup;
use Leeto\MoonShine\Menu\MenuItem;
use Leeto\MoonShine\MoonShine;

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        app(MoonShine::class)
            ->registerResources([
                MenuGroup::make('Products', [
                    MenuItem::make('Products', new ProductResource()),
                    MenuItem::make('Brand', new BrandResource()),
                    MenuItem::make('Categories', new CategoryResource()),
                    MenuItem::make('Properties', new PropertyResource()),
                    MenuItem::make('Options', new OptionResource()),
                ])
            ]);
    }
}

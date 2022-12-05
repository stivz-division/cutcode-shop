<?php

namespace App\Providers;

use Domain\Auth\Providers\AuthServiceProvider;
use Domain\Catalog\Providers\CatalogServiceProvider;
use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->register(
            \Domain\Cart\Providers\CartServiceProvider::class
        );

        $this->app->register(
            \Domain\Product\Providers\ProductServiceProvider::class
        );

        $this->app->register(
            AuthServiceProvider::class,
        );

        $this->app->register(
            CatalogServiceProvider::class,
        );
    }
}

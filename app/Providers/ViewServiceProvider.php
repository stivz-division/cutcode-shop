<?php

namespace App\Providers;

use App\Menu\Menu;
use App\Menu\MenuItem;
use App\View\Composers\NavigationComposer;
use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Vite::macro('image', fn($asset) => $this->asset("resources/images/$asset"));

        View::composer('*', NavigationComposer::class);
    }
}

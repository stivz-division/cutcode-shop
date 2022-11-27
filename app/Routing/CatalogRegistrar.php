<?php

namespace App\Routing;

use App\Http\Controllers\CatalogController;
use App\Http\Middleware\CatalogViewMiddleware;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class CatalogRegistrar implements \App\Contracts\RouteRegistrar
{

    public function map(Registrar $registrar): void
    {
        Route::middleware('web')
            ->group(function () {
                Route::get('/catalog/{category:slug?}', CatalogController::class)
                    ->middleware([CatalogViewMiddleware::class])
                    ->name('catalog');
            });
    }
}

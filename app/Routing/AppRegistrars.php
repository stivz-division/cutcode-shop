<?php

namespace App\Routing;

use App\Http\Controllers\HomeController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AppRegistrars implements \App\Contracts\RouteRegistrar
{

    public function map(Registrar $registrar): void
    {
        Route::middleware('web')
            ->group(function () {
                Route::get('/', HomeController::class)->name('home');
            });
    }
}

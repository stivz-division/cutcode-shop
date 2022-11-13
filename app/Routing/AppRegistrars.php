<?php

namespace App\Routing;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ThumbnailController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AppRegistrars implements \App\Contracts\RouteRegistrar
{

    public function map(Registrar $registrar): void
    {
        Route::middleware('web')
            ->group(function () {
                Route::get('/', HomeController::class)->name('home');

                Route::get('/storage/images/{dir}/{method}/{size}/{file}', ThumbnailController::class)
                    ->where('method', 'resize|crop|fit')
                    ->where('size', '\d+x\d+')
                    ->where('file', '.+\.(png|jpg|gif|bmp|jpeg)$')
                    ->name('thumbnail');
            });
    }
}

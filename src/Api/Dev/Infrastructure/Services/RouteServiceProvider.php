<?php

namespace Src\Api\Dev\Infrastructure\Services;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

final class RouteServiceProvider extends ServiceProvider
{

    protected $namespace = 'Src\Api\Dev\Infrastructure\Controllers';

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapRoutes();
    }

    public function mapRoutes()
    {
        Route::prefix('api/test')
            ->namespace($this->namespace)
            ->group(base_path('src/Api/Dev/Infrastructure/Routes/Api.php'));

    }


}

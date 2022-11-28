<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            //Auth
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api_auth.php'));


            //Users
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api_users.php'));

            //User Statuses
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api_user_statuses.php'));

            //Roles
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api_roles.php'));

            //Role User
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api_role_user.php'));


            //Abilities
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api_abilities.php'));


            //Abilities User
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api_ability_user.php'));



            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}

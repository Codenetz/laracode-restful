<?php

namespace App\Modules\User\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Passport::routes(
            function () {
                Route::post('/token', [
                    'uses' => 'AccessTokenController@issueToken',
                    'as' => 'passport.token',
                    'middleware' => 'throttle',
                ]);
            },
            [
                'prefix' => 'api/oauth'
            ]
        );
    }
}

<?php

namespace App\Providers;

use App\Services\ModulesListing;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $modulesListing = new ModulesListing();
        foreach ($modulesListing->fetchModules() as $moduleName) {
            foreach ($modulesListing->fetchFiles($moduleName, 'Routes') as $file) {
                Route::prefix('api')
                    ->middleware('api')
                    ->namespace('App\Modules\\' . $moduleName . '\Controllers')
                    ->group($file);
            }
        }
    }
}

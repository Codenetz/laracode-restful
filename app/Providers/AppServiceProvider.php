<?php

namespace App\Providers;

use App\Services\ModulesListing;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $modulesListing = new ModulesListing();
        foreach ($modulesListing->fetchModules() as $moduleName) {
            foreach ($modulesListing->fetchFiles($moduleName, 'Config') as $file) {
                $this->mergeConfigFrom($file, basename($file, '.php'));
            }

            $this->loadMigrationsFrom(base_path('app/Modules/' . $moduleName . '/Migrations'));
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}

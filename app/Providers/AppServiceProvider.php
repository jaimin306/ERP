<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->registerBindings();
    }

    /**
     * Register service provider bindings
     */
    public function registerBindings()
    {
        
        $this->app->bind(
            \App\Repositories\Admin\Country\CountryRepositoryContract::class,
            \App\Repositories\Admin\Country\EloquentCountryRepository::class
        );

    }

}

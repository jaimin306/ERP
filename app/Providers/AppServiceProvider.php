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

        $this->app->bind(
            \App\Repositories\Admin\State\StateRepositoryContract::class,
            \App\Repositories\Admin\State\EloquentStateRepository::class
        );

        $this->app->bind(
            \App\Repositories\Admin\Department\DepartmentRepositoryContract::class,
            \App\Repositories\Admin\Department\EloquentDepartmentRepository::class
        );

        $this->app->bind(
            \App\Repositories\Admin\Designation\DesignationRepositoryContract::class,
            \App\Repositories\Admin\Designation\EloquentDesignationRepository::class
        );

        $this->app->bind(
<<<<<<< HEAD
            \App\Repositories\Admin\Menu\MenuRepositoryContract::class,
            \App\Repositories\Admin\Menu\EloquentMenuRepository::class
=======
            \App\Repositories\Admin\Setting\SettingRepositoryContract::class,
            \App\Repositories\Admin\Setting\EloquentSettingRepository::class
        );

        $this->app->bind(
            \App\Repositories\Admin\AccountType\AccountTypeRepositoryContract::class,
            \App\Repositories\Admin\AccountType\EloquentAccountTypeRepository::class
>>>>>>> ebba80d711129a59eb237c7751f6ad182cb6a983
        );

    }

}

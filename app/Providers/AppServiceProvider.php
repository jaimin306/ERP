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
            \App\Repositories\Admin\Menu\MenuRepositoryContract::class,
            \App\Repositories\Admin\Menu\EloquentMenuRepository::class
        );

        $this->app->bind(
            \App\Repositories\Admin\MenuPermission\MenuPermissionRepositoryContract::class,
            \App\Repositories\Admin\MenuPermission\EloquentMenuPermissionRepository::class
        );

        $this->app->bind(
            \App\Repositories\Admin\User\UserRepositoryContract::class,
            \App\Repositories\Admin\User\EloquentUserRepository::class
        );

        $this->app->bind(
            \App\Repositories\Admin\AccountType\AccountTypeRepositoryContract::class,
            \App\Repositories\Admin\AccountType\EloquentAccountTypeRepository::class
        );

        $this->app->bind(
            \App\Repositories\Admin\BankAccount\BankAccountRepositoryContract::class,
            \App\Repositories\Admin\BankAccount\EloquentBankAccountRepository::class
        );

        $this->app->bind(
            \App\Repositories\Admin\Settings\SettingsRepositoryContract::class,
            \App\Repositories\Admin\Settings\EloquentSettingsRepository::class
        );

        $this->app->bind(
            \App\Repositories\Admin\VendorType\VendorTypeRepositoryContract::class,
            \App\Repositories\Admin\VendorType\EloquentVendorTypeRepository::class
        );

        $this->app->bind(
            \App\Repositories\Admin\Vendor\VendorRepositoryContract::class,
            \App\Repositories\Admin\Vendor\EloquentVendorRepository::class
        );

        $this->app->bind(
            \App\Repositories\Admin\ItemType\ItemTypeRepositoryContract::class,
            \App\Repositories\Admin\ItemType\EloquentItemTypeRepository::class
        );

        $this->app->bind(
            \App\Repositories\Admin\ItemCategory\ItemCategoryRepositoryContract::class,
            \App\Repositories\Admin\ItemCategory\EloquentItemCategoryRepository::class
        );

        $this->app->bind(
            \App\Repositories\Admin\Item\ItemRepositoryContract::class,
            \App\Repositories\Admin\Item\EloquentItemRepository::class
        );
    
        

    }

}

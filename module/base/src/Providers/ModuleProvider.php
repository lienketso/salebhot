<?php


namespace Base\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;


class ModuleProvider extends ServiceProvider
{
    public function boot(){
        $this->loadViewsFrom(__DIR__.'/../../resources/views','wadmin-dashboard');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->publishes([__DIR__.'/../../resources/public/'=> public_path()],'wadmin-public-assets');
        $this->app->booted(function (){
            $this->booted();
        });
    }

    public function booted(){
        $currentUrl = url()->current();
        $check = explode('/',$currentUrl);
    }

    public function register()
    {
        \Base\Supports\Helper::loadModuleHelpers(__DIR__);

        config([
            'auth.defaults' => [
                'guard' => 'wadmin',
                'passwords' => 'admin-users',
            ],
            'auth.guards.wadmin' => [
                'driver' => 'session',
                'provider' => 'admin-users',
            ],
            'auth.providers.admin-users' => [
                'driver' => 'eloquent',
                'model' => \Users\Models\Users::class,
                'table' => 'users'
            ],
            'auth.passwords.admin-users' => [
                'provider' => 'admin-users',
                'table' => 'password_resets',
                'expire' => 60,
            ],
        ]);

        $this->mergeConfigFrom(__DIR__ . '/../../config/base.php', 'base');
        $this->app->register(RouteProvider::class);
        //Register related facades
        $loader = AliasLoader::getInstance();
        $loader->alias('Debugbar',\Barryvdh\Debugbar\Facade::class);
        /**
         * Other packages
         */
        $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        /**
         * Other module providers
         */
        $this->app->register(\Auth\Providers\ModuleProvider::class);
        $this->app->register(\Hook\Providers\ModuleProvider::class);
        $this->app->register(\Users\Providers\ModuleProvider::class);
        $this->app->register(\Acl\Providers\ModuleProvider::class);
        $this->app->register(\Post\Providers\ModuleProvider::class);
        $this->app->register(\Page\Providers\ModuleProvider::class);
        $this->app->register(\Video\Providers\ModuleProvider::class);
        $this->app->register(\Category\Providers\ModuleProvider::class);
        $this->app->register(\Menu\Providers\ModuleProvider::class);
        $this->app->register(\Setting\Providers\ModuleProvider::class);
        $this->app->register(\Contact\Providers\ModuleProvider::class);
        $this->app->register(\Product\Providers\ModuleProvider::class);
        $this->app->register(\Media\Providers\ModuleProvider::class);
        $this->app->register(\Company\Providers\ModuleProvider::class);
        $this->app->register(\Newsletter\Providers\ModuleProvider::class);
        $this->app->register(\Transaction\Providers\ModuleProvider::class);
        $this->app->register(\Gallery\Providers\ModuleProvider::class);
        $this->app->register(\Project\Providers\ModuleProvider::class);
        $this->app->register(\Vendor\Providers\ModuleProvider::class);
        $this->app->register(\Frontend\Providers\ModuleProvider::class);
        $this->app->register(\Order\Providers\ModuleProvider::class);
        $this->app->register(\Location\Providers\ModuleProvider::class);
        $this->app->register(\Expert\Providers\ModuleProvider::class);
        $this->app->register(\Commission\Providers\ModuleProvider::class);
        $this->app->register(\Reports\Providers\ModuleProvider::class);
        $this->app->register(\Wallets\Providers\ModuleProvider::class);
        $this->app->register(\Logs\Providers\ModuleProvider::class);
        $this->app->register(\Discounts\Providers\ModuleProvider::class);
        $this->app->register(\Director\Providers\ModuleProvider::class);
        $this->app->register(\Sales\Providers\ModuleProvider::class);
    }

}

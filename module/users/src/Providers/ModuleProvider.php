<?php
namespace Users\Providers;

use Barryvdh\Debugbar\ServiceProvider;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
       $this->loadViewsFrom(__DIR__.'/../../resources/views','wadmin-users');
       $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }

    public function register()
    {
        $this->app->register(RouteProviders::class);
        $this->app->register(HookProvider::class);
    }

}

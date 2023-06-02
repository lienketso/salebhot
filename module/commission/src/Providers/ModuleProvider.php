<?php

namespace Commission\Providers;

use Barryvdh\Debugbar\ServiceProvider;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views','wadmin-commission');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }
    public function register()
    {
        $this->app->register(HookProvider::class);
        $this->app->register(RouteProvider::class);
    }
}

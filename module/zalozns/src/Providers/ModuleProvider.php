<?php

namespace ZaloZns\Providers;
use Barryvdh\Debugbar\ServiceProvider;
class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views','wadmin-zalozns');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }
    public function register()
    {
        $this->app->register(RouteProvider::class);
        $this->app->register(HookProvider::class);
    }
}

<?php


namespace Auth\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider
{
    public function boot(){
        $this->loadViewsFrom(__DIR__.'/../../resources/views','wadmin-auth');

    }

    public function register()
    {
       $this->app->register(RouteProvider::class);
       $this->app->register(MiddlewareProvider::class);
    }

}

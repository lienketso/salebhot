<?php


namespace Auth\Providers;

use Auth\Http\Middleware\Authenticated;
use Illuminate\Support\ServiceProvider;


class MiddlewareProvider extends ServiceProvider
{
    public function boot(){

    }

    public function register()
    {
        $this->app['router']->aliasMiddleware('wadmin', Authenticated::class);
        $this->app['router']->pushMiddlewareToGroup('web', Authenticated::class);
    }
}

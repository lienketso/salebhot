<?php
namespace Hook\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider{

public function boot()
{

}

    public function register()
    {
        $this->loadHelpers();
    }

    protected function loadHelpers()
    {
        $helpers = $this->app['files']->glob(__DIR__ . '/../../helpers/*.php');
        foreach ($helpers as $helper) {
            require_once $helper;
        }
    }
}

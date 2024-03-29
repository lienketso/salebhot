<?php

namespace Accountant\Providers;

use Illuminate\Support\ServiceProvider;
use Accountant\Hook\AccountantHook;

class HookProvider extends ServiceProvider
{
    public function boot(){
        $this->app->booted(function (){
            $this->booted();
        });
    }
    public function register()
    {
        parent::register(); // TODO: Change the autogenerated stub
    }
    public function booted(){
        add_action('wadmin-register-menu',[AccountantHook::class,'handle'],36);
    }
}

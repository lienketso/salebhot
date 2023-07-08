<?php

namespace Discounts\Providers;

use Discounts\Hook\DiscountsHook;
use Illuminate\Support\ServiceProvider;

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
        add_action('wadmin-register-menu',[DiscountsHook::class,'handle'],10);
    }
}

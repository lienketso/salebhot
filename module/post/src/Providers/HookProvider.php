<?php


namespace Post\Providers;


use Illuminate\Support\ServiceProvider;
use Post\Hook\PostHook;

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
//        add_action('wadmin-register-menu',[PostHook::class,'handle'],3);
    }
}

<?php


namespace Menu\Providers;


use Illuminate\Support\ServiceProvider;
use Menu\Hook\MenuHook;

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
//        add_action('wadmin-register-menu',[MenuHook::class,'handle'],1);
    }
}

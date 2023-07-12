<?php


namespace Director\Providers;


use Illuminate\Support\ServiceProvider;
use Director\Hook\DirectorHook;

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
        add_action('wadmin-register-menu',[DirectorHook::class,'handle'],5);
    }
}

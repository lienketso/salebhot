<?php

namespace App\Providers;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Menu\Models\Menu;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $listContact = DB::table('contact')->where('status','disable')->limit(10)->get();
        View::share('listContact',$listContact);
        $countContact = DB::table('contact')->where('status','disable')->count();
        View::share('countContact',$countContact);
        if(!session('lang') || session('lang')==null){
            session()->put(['lang'=>config('app.locale')]);
        }

    }
}

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
        //số nhà phân phối chưa được duyệt
        $countComPending = DB::table('company')
            ->where('status','pending')->where('c_type','distributor')->count();
        View::share('countComPending',$countComPending);
        //Số yêu cầu rút tiền
        $countWithdraw = DB::table('wallet_transaction')->where('transaction_type','minus')
            ->where('status','pending')->count();
        View::share('countWithdraw',$countWithdraw);
        if(!session('lang') || session('lang')==null){
            session()->put(['lang'=>config('app.locale')]);
        }

    }
}

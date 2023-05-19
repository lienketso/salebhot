<?php

$adminRoute = config('base.admin_route');
$moduleRoute = 'auth';

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

Route::group(['prefix'=>$adminRoute], function(Router $router) use($adminRoute,$moduleRoute){

    $router->get('/',function () use ($adminRoute,$moduleRoute){
       return redirect()->to($adminRoute.'/'.$moduleRoute.'/login');
    });

    $router->group(['prefix'=>$moduleRoute], function(Router $router) use($adminRoute,$moduleRoute){
        $router->get('login', 'AuthController@getLogin')->name('wadmin::auth.login.get');
        $router->post('login', 'AuthController@postLogin')->name('wadmin::auth.login.post');
        $router->get('logout', 'AuthController@getLogout')->name('wadmin::auth.logout.get');
    });
});

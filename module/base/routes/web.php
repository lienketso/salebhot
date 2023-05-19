<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'dashboard';

Route::group(['prefix'=>$adminRoute], function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute], function(Router $router) use($adminRoute,$moduleRoute){
        $router->get('index','DashboardController@getIndex')->name('wadmin::dashboard.index.get');
        $router->post('index','DashboardController@postIndex')->name('wadmin::dashboard.index.post');
        $router->post('ckeditor/upload', 'DashboardController@upload')->name('ckeditor.upload');
        $router->get('lang/{lang}','DashboardController@changeLang')->name('dashboard.lang');
        $router->get('send-mail','DashboardController@addFeedback')->name('dashboard.sendmail');
    });
});




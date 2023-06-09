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
        $router->get('send-zns','DashboardController@sendZns')->name('dashboard.sendznd');
        $router->get('send-zalo-zns','DashboardController@getAccessToken')->name('dashboard.send-zalo-zns');
        $router->get('send-zalo-token','DashboardController@getTokenFromRefresh')->name('dashboard.send-zalo-token');
    });
});




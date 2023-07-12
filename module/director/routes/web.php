<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'director';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','DirectorController@getIndex')
            ->name('wadmin::director.index.get')->middleware('permission:director_index');
        $router->get('experts','DirectorController@getExpert')
            ->name('wadmin::director.expert.get')->middleware('permission:director_expert');

        //revenue
        $router->get('revenue','DirectorController@revenue')
            ->name('wadmin::director.revenue.get')->middleware('permission:director_revenue');
    });
});

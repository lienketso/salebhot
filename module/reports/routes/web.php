<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'reports';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('distributor','ReportsController@distributor')
            ->name('wadmin::reports.distributor.get')->middleware('permission:commission_index');
        $router->get('experts','ReportsController@experts')
            ->name('wadmin::reports.experts.get')->middleware('permission:commission_create');
        $router->get('director','ReportsController@director')
            ->name('wadmin::reports.director.get')->middleware('permission:commission_create');

    });
});

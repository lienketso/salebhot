<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'reports';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('distributor','ReportsController@distributor')
            ->name('wadmin::reports.distributor.get')->middleware('permission:report_distributor');
        $router->get('experts','ReportsController@experts')
            ->name('wadmin::reports.experts.get')->middleware('permission:report_expert');
        $router->get('director','ReportsController@director')
            ->name('wadmin::reports.director.get')->middleware('permission:report_director');
        $router->get('total-distributor','ReportsController@totalDistributor')
            ->name('wadmin::reports.total.distributor')->middleware('permission:report_total_distributor');

    });
});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'sales';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','SalesController@getIndex')
            ->name('wadmin::sales.index.get')->middleware('permission:sales_index');
        $router->get('experts','SalesController@getExpert')
            ->name('wadmin::sales.expert.get')->middleware('permission:sales_expert');
        $router->get('success','SalesController@success')
            ->name('wadmin::sales.success.get')->middleware('permission:sales_success');
        //revenue
        $router->get('revenue','SalesController@revenue')
            ->name('wadmin::sales.revenue.get')->middleware('permission:sales_revenue');
    });
});

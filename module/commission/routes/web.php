<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'commission';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','CommissionController@getIndex')
            ->name('wadmin::commission.index.get')->middleware('permission:commission_index');
        $router->get('create','CommissionController@getCreate')
            ->name('wadmin::commission.create.get')->middleware('permission:commission_create');
        $router->post('create','CommissionController@postCreate')
            ->name('wadmin::commission.create.post')->middleware('permission:commission_create');
        $router->get('edit/{id}','CommissionController@getEdit')
            ->name('wadmin::commission.edit.get')->middleware('permission:commission_edit');
        $router->post('edit/{id}','CommissionController@postEdit')
            ->name('wadmin::commission.edit.post')->middleware('permission:commission_edit');
        $router->get('remove/{id}','CommissionController@remove')
            ->name('wadmin::commission.remove.get')->middleware('permission:commission_delete');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'zalozns';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','ZaloZnsController@getIndex')
            ->name('wadmin::zalozns.index.get')->middleware('permission:zalo_index');
        $router->get('create','ZaloZnsController@getCreate')
            ->name('wadmin::zalozns.create.get')->middleware('permission:zalo_create');
        $router->post('create','ZaloZnsController@postCreate')
            ->name('wadmin::zalozns.create.post')->middleware('permission:zalo_create');
        $router->get('edit/{id}','ZaloZnsController@getEdit')
            ->name('wadmin::zalozns.edit.get')->middleware('permission:zalo_edit');
        $router->post('edit/{id}','ZaloZnsController@postEdit')
            ->name('wadmin::zalozns.edit.post')->middleware('permission:zalo_edit');
        $router->get('delete/{id}','ZaloZnsController@getDelete')
            ->name('wadmin::zalozns.delete.get')->middleware('permission:zalo_delete');
        //param
        $router->get('param/{id}','ZaloZnsController@getParamIndex')->name('wadmin::zalozns.param.index');
        $router->get('param-create/{id}','ZaloZnsController@getParamCreate')->name('wadmin::zalozns.param.create');
        $router->post('param-create/{id}','ZaloZnsController@postParamCreate')->name('wadmin::zalozns.param.create.post');
    });
});

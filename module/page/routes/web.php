<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'page';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','PageController@getIndex')
            ->name('wadmin::page.index.get')->middleware('permission:page_index');
        $router->get('create','PageController@getCreate')
            ->name('wadmin::page.create.get')->middleware('permission:page_create');
        $router->post('create','PageController@postCreate')
            ->name('wadmin::page.create.post')->middleware('permission:page_create');
        $router->get('edit/{id}','PageController@getEdit')
            ->name('wadmin::page.edit.get')->middleware('permission:page_edit');
        $router->post('edit/{id}','PageController@postEdit')
            ->name('wadmin::page.edit.post')->middleware('permission:page_edit');
        $router->get('remove/{id}','PageController@remove')
            ->name('wadmin::page.remove.get')->middleware('permission:page_delete');
        $router->get('change/{id}','PageController@changeStatus')
            ->name('wadmin::page.change.get');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'category';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','CategoryController@getIndex')
            ->name('wadmin::category.index.get')->middleware('permission:category_index');
        $router->get('create','CategoryController@getCreate')
            ->name('wadmin::category.create.get')->middleware('permission:category_create');
        $router->post('create','CategoryController@postCreate')
            ->name('wadmin::category.create.post')->middleware('permission:category_create');
        $router->get('edit/{id}','CategoryController@getEdit')
            ->name('wadmin::category.edit.get')->middleware('permission:category_edit');
        $router->post('edit/{id}','CategoryController@postEdit')
            ->name('wadmin::category.edit.post')->middleware('permission:category_edit');
        $router->get('remove/{id}','CategoryController@remove')
            ->name('wadmin::category.remove.get')->middleware('permission:category_delete');
        $router->get('change/{id}','CategoryController@changeStatus')
            ->name('wadmin::category.change.get');
    });
});

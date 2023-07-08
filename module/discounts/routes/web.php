<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'discounts';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','DiscountsController@getIndex')
            ->name('wadmin::discounts.index.get')->middleware('permission:discounts_index');
        $router->get('create','DiscountsController@getCreate')
            ->name('wadmin::discounts.create.get')->middleware('permission:discounts_create');
        $router->post('create','DiscountsController@postCreate')
            ->name('wadmin::discounts.create.post')->middleware('permission:discounts_create');
        $router->get('edit/{id}','DiscountsController@getEdit')
            ->name('wadmin::discounts.edit.get')->middleware('permission:discounts_edit');
        $router->post('edit/{id}','DiscountsController@postEdit')
            ->name('wadmin::discounts.edit.post')->middleware('permission:discounts_edit');
        $router->get('remove/{id}','DiscountsController@remove')
            ->name('wadmin::discounts.remove.get')->middleware('permission:discounts_delete');

    });
});

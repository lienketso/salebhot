<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'product';
$catRoute = 'cat';
$facRoute = 'factory';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute,$catRoute,$facRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','ProductController@getIndex')
            ->name('wadmin::product.index.get')->middleware('permission:product_index');
        $router->get('create','ProductController@getCreate')
            ->name('wadmin::product.create.get')->middleware('permission:product_create');
        $router->post('create','ProductController@postCreate')
            ->name('wadmin::product.create.post')->middleware('permission:product_create');
        $router->get('edit/{id}','ProductController@getEdit')
            ->name('wadmin::product.edit.get')->middleware('permission:product_edit');
        $router->post('edit/{id}','ProductController@postEdit')
            ->name('wadmin::product.edit.post')->middleware('permission:product_edit');
        $router->get('remove/{id}','ProductController@remove')
            ->name('wadmin::product.remove.get')->middleware('permission:product_delete');
        $router->get('change/{id}','ProductController@changeStatus')
            ->name('wadmin::product.change.get');
    });
    //category product route
    $router->group(['prefix'=>$catRoute],function(Router $router) use ($adminRoute,$catRoute){
        $router->get('index','CatproductController@getIndex')
            ->name('wadmin::cat.index.get')->middleware('permission:cat_index');
        $router->get('create','CatproductController@getCreate')
            ->name('wadmin::cat.create.get')->middleware('permission:cat_create');
        $router->post('create','CatproductController@postCreate')
            ->name('wadmin::cat.create.post')->middleware('permission:cat_create');
        $router->get('edit/{id}','CatproductController@getEdit')
            ->name('wadmin::cat.edit.get')->middleware('permission:cat_edit');
        $router->post('edit/{id}','CatproductController@postEdit')
            ->name('wadmin::cat.edit.post')->middleware('permission:cat_edit');
        $router->get('remove/{id}','CatproductController@remove')
            ->name('wadmin::cat.remove.get')->middleware('permission:cat_delete');
        $router->get('change/{id}','CatproductController@changeStatus')
            ->name('wadmin::cat.change.get');
    });

    //factory route
    $router->group(['prefix'=>$facRoute],function(Router $router) use ($adminRoute,$facRoute){
        $router->get('index','FactoryController@getIndex')
            ->name('wadmin::factory.index.get')->middleware('permission:factory_index');
        $router->get('create','FactoryController@getCreate')
            ->name('wadmin::factory.create.get')->middleware('permission:factory_create');
        $router->post('create','FactoryController@postCreate')
            ->name('wadmin::factory.create.post')->middleware('permission:factory_create');
        $router->get('edit/{id}','FactoryController@getEdit')
            ->name('wadmin::factory.edit.get')->middleware('permission:factory_edit');
        $router->post('edit/{id}','FactoryController@postEdit')
            ->name('wadmin::factory.edit.post')->middleware('permission:factory_edit');
        $router->get('remove/{id}','FactoryController@remove')
            ->name('wadmin::factory.remove.get')->middleware('permission:factory_delete');
        $router->get('change/{id}','FactoryController@changeStatus')
            ->name('wadmin::factory.change.get');
    });

});

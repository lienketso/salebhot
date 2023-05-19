<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'vendor';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','VendorController@getIndex')
            ->name('wadmin::vendor.index.get')->middleware('permission:vendor_index');
        $router->get('create','VendorController@getCreate')
            ->name('wadmin::vendor.create.get')->middleware('permission:vendor_create');
        $router->post('create','VendorController@postCreate')
            ->name('wadmin::vendor.create.post')->middleware('permission:vendor_create');
        $router->get('edit/{id}','VendorController@getEdit')
            ->name('wadmin::vendor.edit.get')->middleware('permission:vendor_edit');
        $router->post('edit/{id}','VendorController@postEdit')
            ->name('wadmin::vendor.edit.post')->middleware('permission:vendor_edit');
        $router->get('remove/{id}','VendorController@remove')
            ->name('wadmin::vendor.remove.get')->middleware('permission:vendor_delete');
        $router->get('change/{id}','VendorController@changeStatus')
            ->name('wadmin::vendor.change.get');
    });


});

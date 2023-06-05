<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'company';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','CompanyController@getIndex')
            ->name('wadmin::company.index.get')->middleware('permission:company_index');
        $router->get('create','CompanyController@getCreate')
            ->name('wadmin::company.create.get')->middleware('permission:company_create');
        $router->post('create','CompanyController@postCreate')
            ->name('wadmin::company.create.post')->middleware('permission:company_create');
        $router->get('edit/{id}','CompanyController@getEdit')
            ->name('wadmin::company.edit.get')->middleware('permission:company_edit');
        $router->post('edit/{id}','CompanyController@postEdit')
            ->name('wadmin::company.edit.post')->middleware('permission:company_edit');
        $router->get('remove/{id}','CompanyController@remove')
            ->name('wadmin::company.remove.get')->middleware('permission:company_delete');
        $router->get('change/{id}','CompanyController@changeStatus')
            ->name('wadmin::company.change.get');
        $router->get('export','CompanyController@export')->name('wadmin::company.export.get');
        $router->get('status','CompanyController@status')->name('wadmin::company.status.get');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'project';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','ProjectController@getIndex')
            ->name('wadmin::project.index.get')->middleware('permission:project_index');
        $router->get('create','ProjectController@getCreate')
            ->name('wadmin::project.create.get')->middleware('permission:project_create');
        $router->post('create','ProjectController@postCreate')
            ->name('wadmin::project.create.post')->middleware('permission:project_create');
        $router->get('edit/{id}','ProjectController@getEdit')
            ->name('wadmin::project.edit.get')->middleware('permission:project_edit');
        $router->post('edit/{id}','ProjectController@postEdit')
            ->name('wadmin::project.edit.post')->middleware('permission:project_edit');
        $router->get('remove/{id}','ProjectController@remove')
            ->name('wadmin::project.remove.get')->middleware('permission:project_delete');
        $router->get('change/{id}','ProjectController@changeStatus')
            ->name('wadmin::project.change.get');
    });
});

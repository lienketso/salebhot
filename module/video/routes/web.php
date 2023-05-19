<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'video';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','VideoController@getIndex')
            ->name('wadmin::video.index.get')->middleware('permission:video_index');
        $router->get('create','VideoController@getCreate')
            ->name('wadmin::video.create.get')->middleware('permission:video_create');
        $router->post('create','VideoController@postCreate')
            ->name('wadmin::video.create.post')->middleware('permission:video_create');
        $router->get('edit/{id}','VideoController@getEdit')
            ->name('wadmin::video.edit.get')->middleware('permission:video_edit');
        $router->post('edit/{id}','VideoController@postEdit')
            ->name('wadmin::video.edit.post')->middleware('permission:video_edit');
        $router->get('remove/{id}','VideoController@remove')
            ->name('wadmin::video.remove.get')->middleware('permission:video_delete');
        $router->get('change/{id}','VideoController@changeStatus')
            ->name('wadmin::video.change.get');
    });
});

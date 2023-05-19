<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'gallery';
$groupRoute = 'group';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute,$groupRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','GalleryController@getIndex')
            ->name('wadmin::gallery.index.get')->middleware('permission:gallery_index');
        $router->get('create','GalleryController@getCreate')
            ->name('wadmin::gallery.create.get')->middleware('permission:gallery_create');
        $router->post('create','GalleryController@postCreate')
            ->name('wadmin::gallery.create.post')->middleware('permission:gallery_create');
        $router->get('edit/{id}','GalleryController@getEdit')
            ->name('wadmin::gallery.edit.get')->middleware('permission:gallery_edit');
        $router->post('edit/{id}','GalleryController@postEdit')
            ->name('wadmin::gallery.edit.post')->middleware('permission:gallery_edit');
        $router->get('remove/{id}','GalleryController@remove')
            ->name('wadmin::gallery.remove.get')->middleware('permission:gallery_delete');
        $router->get('change/{id}','GalleryController@changeStatus')
            ->name('wadmin::gallery.change.get');
    });

    $router->group(['prefix'=>$groupRoute],function(Router $router) use ($adminRoute,$groupRoute){
        $router->get('index','GroupController@getIndex')
            ->name('wadmin::group.index.get')->middleware('permission:group_index');
        $router->get('change/{id}','GroupController@changeStatus')
            ->name('wadmin::group.change.get');
    });

});

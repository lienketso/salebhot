<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'post';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','PostsController@getIndex')
            ->name('wadmin::post.index.get')->middleware('permission:post_index');
        $router->get('create','PostsController@getCreate')
            ->name('wadmin::post.create.get')->middleware('permission:post_create');
        $router->post('create','PostsController@postCreate')
            ->name('wadmin::post.create.post')->middleware('permission:post_create');
        $router->get('edit/{id}','PostsController@getEdit')
            ->name('wadmin::post.edit.get')->middleware('permission:post_edit');
        $router->post('edit/{id}','PostsController@postEdit')
            ->name('wadmin::post.edit.post')->middleware('permission:post_edit');
        $router->get('remove/{id}','PostsController@remove')
            ->name('wadmin::post.remove.get')->middleware('permission:post_delete');
        $router->get('change/{id}','PostsController@changeStatus')
            ->name('wadmin::post.change.get');

    });
});

Route::get('san-pham/index','PostsController@getIndexProduct')
    ->name('wadmin::sanpham.index.get')->middleware('permission:post_index');
Route::get('/san-pham/create','PostsController@getCreateProduct')
    ->name('wadmin::sanpham.create.get');
Route::post('/san-pham/create','PostsController@postCreateProduct')
    ->name('wadmin::sanpham.create.post');
Route::get('/san-pham/edit/{id}','PostsController@getEditProduct')
    ->name('wadmin::sanpham.edit.get');
Route::post('/san-pham/edit/{id}','PostsController@postEditProduct')
    ->name('wadmin::sanpham.edit.post');

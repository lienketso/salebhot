<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'users';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
   $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
       $router->get('index','UsersController@getIndex')
           ->name('wadmin::users.index.get')->middleware('permission:users_index');
       $router->get('create','UsersController@getCreate')
           ->name('wadmin::users.create.get')->middleware('permission:users_create');
       $router->post('create','UsersController@postCreate')
           ->name('wadmin::users.create.post')->middleware('permission:users_create');
       $router->get('edit/{id}','UsersController@getEdit')
           ->name('wadmin::users.edit.get')->middleware('permission:users_edit');
       $router->post('edit/{id}','UsersController@postEdit')
           ->name('wadmin::users.edit.post')->middleware('permission:users_edit');
       $router->get('remove/{id}','UsersController@remove')
           ->name('wadmin::users.remove.get')->middleware('permission:users_delete');
       $router->get('profile/{id}','UsersController@getProfile')
           ->name('wadmin::users.profile.get')->middleware('permission:users_edit');
       $router->post('profile/{id}','UsersController@postProfile')
           ->name('wadmin::users.profile.post')->middleware('permission:users_edit');

   });
});

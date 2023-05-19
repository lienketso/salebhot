<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/26/2017
 * Time: 11:29 AM
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'acl';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->group(['prefix' => 'role'], function(Router $router) {
            $router->get('index','RoleController@getIndex')->name('wadmin::role.index.get');
            $router->get('create','RoleController@getCreate')->name('wadmin::role.create.get');
            $router->post('create','RoleController@postCreate')->name('wadmin::role.create.post');
            $router->get('edit/{id}','RoleController@getEdit')->name('wadmin::role.edit.get');
            $router->post('edit/{id}','RoleController@postEdit')->name('wadmin::role.edit.post');
            $router->get('remove/{id}','RoleController@remove')->name('wadmin::role.remove.get');
        });
        $router->group(['prefix' => 'permission'], function(Router $router) {
            $router->get('index','PermissionController@getIndex')->name('wadmin::permission.index.get');
            $router->get('create','PermissionController@getCreate')->name('wadmin::permission.create.get');
            $router->post('create','PermissionController@postCreate')->name('wadmin::permission.create.post');
            $router->get('edit/{id}','PermissionController@getEdit')->name('wadmin::permission.edit.get');
            $router->post('edit/{id}','PermissionController@postEdit')->name('wadmin::permission.edit.post');
            $router->get('remove/{id}','PermissionController@remove')->name('wadmin::permission.remove.get');
        });

    });

});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'contact';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','ContactController@getIndex')
            ->name('wadmin::contact.index.get')->middleware('permission:contact_index');
        $router->get('remove/{id}','ContactController@remove')
            ->name('wadmin::contact.remove.get')->middleware('permission:contact_delete');
        $router->get('change/{id}','ContactController@changeStatus')
            ->name('wadmin::contact.change.get');
    });
});

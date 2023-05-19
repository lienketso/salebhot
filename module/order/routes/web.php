<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'order';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','OrderController@getIndex')
            ->name('wadmin::order.index.get');
        $router->get('update/{id}','OrderController@update')
            ->name('wadmin::order.update.get');
        $router->get('remove/{id}','OrderController@remove')
            ->name('wadmin::order.remove.get');
    });
});

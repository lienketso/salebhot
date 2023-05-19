<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'newsletter';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','NewsletterController@getIndex')
            ->name('wadmin::newsletter.index.get')->middleware('permission:newsletter_index');
        $router->get('remove/{id}','NewsletterController@remove')
            ->name('wadmin::newsletter.remove.get')->middleware('permission:newsletter_delete');
    });
});

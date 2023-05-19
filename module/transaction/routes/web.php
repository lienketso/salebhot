<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'transaction';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','TransactionController@getIndex')
            ->name('wadmin::transaction.index.get')->middleware('permission:transaction_index');
        $router->get('remove/{id}','TransactionController@remove')
            ->name('wadmin::transaction.remove.get')->middleware('permission:transaction_delete');
        $router->get('change/{id}','TransactionController@changeStatus')
            ->name('wadmin::transaction.change.get');
    });
});

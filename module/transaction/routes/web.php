<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'transaction';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','TransactionController@getIndex')
            ->name('wadmin::transaction.index.get')->middleware('permission:transaction_index');

        $router->get('create','TransactionController@getCreate')
            ->name('wadmin::transaction.create.get')->middleware('permission:transaction_create');
        $router->post('create','TransactionController@postCreate')
            ->name('wadmin::transaction.create.post')->middleware('permission:transaction_create');

        $router->get('edit/{id}','TransactionController@getEdit')
            ->name('wadmin::transaction.edit.get')->middleware('permission:transaction_edit');
        $router->post('edit/{id}','TransactionController@postEdit')
            ->name('wadmin::transaction.edit.post')->middleware('permission:transaction_edit');

        $router->get('remove/{id}','TransactionController@remove')
            ->name('wadmin::transaction.remove.get')->middleware('permission:transaction_delete');
        $router->get('change/{id}','TransactionController@changeStatus')
            ->name('wadmin::transaction.change.get');
        $router->get('accept-order','TransactionController@accept')
            ->name('wadmin::transaction.accept.get')->middleware('permission:transaction_accept');
        $router->post('change-all','TransactionController@changeAll')
            ->name('wadmin::transaction.changeall.get')->middleware('permission:transaction_accept');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'wallets';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','WalletController@getIndex')
            ->name('wadmin::wallet.index.get')->middleware('permission:wallets_index');
        $router->get('history','WalletController@history')
            ->name('wadmin::wallet.history.get')->middleware('permission:wallets_history');
        $router->get('withdraw','WalletController@withdraw')
            ->name('wadmin::wallet.withdraw.get')->middleware('permission:wallets_withdraw');
        $router->get('withdraw-post/{id}','WalletController@withdrawAccept')
            ->name('wadmin::wallet.withdraw.post')->middleware('permission:wallets_withdraw');
        $router->get('withdraw-accept','WalletController@withdrawDone')
            ->name('wadmin::wallet.accept.get')->middleware('permission:wallets_withdraw');
        $router->get('withdraw-refund/{id}','WalletController@getRefund')
            ->name('wadmin::wallet.refund.get')->middleware('permission:wallets_refund');
        $router->post('withdraw-refund/{id}','WalletController@postRefund')
            ->name('wadmin::wallet.refund.post')->middleware('permission:wallets_refund');
        $router->get('withdraw-list-refund','WalletController@refundList')
            ->name('wadmin::wallet.list-refund.get')->middleware('permission:wallets_refund');
    });
});

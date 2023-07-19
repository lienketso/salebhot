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
        //Danh sách duyệt nhà phân phối
        $router->get('withdraw','WalletController@withdraw')
            ->name('wadmin::wallet.withdraw.get')->middleware('permission:wallets_withdraw');
        //Admin duyệt đi tiền nhà phân phối
        $router->get('withdraw-admin-confirm/{id}','WalletController@bankConfirm')
            ->name('wadmin::wallet.admin-confirm.get')->middleware('permission:wallets_confirm');
        //Admin duyệt nhanh nhà  chuyển tiền nhà phân phối
        $router->post('withdraw-admin-confirm-all','WalletController@bankConfirmAll')
            ->name('wadmin::withdraw-admin-confirm-all.post')->middleware('permission:wallets_confirm');
        //admin duyệt xác nhận kế toán chuyển tiền thành công
        $router->get('admin-confirm-success','WalletController@successBank')
            ->name('wadmin::admin-confirm-success.get')->middleware('permission:wallets_bank_success');
        $router->get('admin-confirm-success-get/{id}','WalletController@postSuccessBank')
            ->name('wadmin::admin-confirm-completed.get')->middleware('permission:wallets_bank_success');
        $router->post('admin-completed-all','WalletController@successAll')
            ->name('wadmin::admin-completed-all.post')->middleware('permission:wallets_bank_success');
        //end
        //Danh sách chuyển tiền hoàn thành
        $router->get('list-completed-bank','WalletController@listCompleted')
            ->name('wadmin::list-completed-bank.get')->middleware('permission:wallets_bank_success');

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

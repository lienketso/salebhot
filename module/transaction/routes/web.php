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
        $router->get('change-price/{id}','TransactionController@price')
            ->name('wadmin::transaction.price.get')->middleware('permission:transaction_price');
        $router->post('change-price/{id}','TransactionController@postPrice')
            ->name('wadmin::transaction.price.post')->middleware('permission:transaction_price');
        // đơn hàng đã xóa
        $router->get('removed','TransactionController@removed')
            ->name('wadmin::transaction.removed.get')->middleware('permission:transaction_removed');
        //chi tiết đơn hàng
        $router->get('transaction-detail/{id}','TransactionController@detail')
            ->name('wadmin::transaction.detail.get')->middleware('permission:transaction_detail');
        //Đơn hàng sắp hết hạn
        $router->get('transaction-expiry','TransactionController@expiry')
            ->name('wadmin::transaction.expiry.get')->middleware('permission:transaction_expiry');
        //Đơn hàng thành công
        $router->get('transaction-success','TransactionController@orderSuccess')
            ->name('wadmin::transaction.success.get')->middleware('permission:transaction_success');
        $router->get('refund-transaction/{id}','TransactionController@refundOrder')
            ->name('wadmin::transaction.refund.get')->middleware('permission:transaction_refund');
        $router->get('transaction-refunded','TransactionController@orderRefunded')
            ->name('wadmin::transaction.refunded.get')->middleware('permission:transaction_refunded');

        $router->get('chanel-telegram','TransactionController@updatedActivity')->name('wadmin::telegrame.chanel.get');


        //update nhanh
        $router->get('update-transaction-admin','TransactionController@updateTransaction')
            ->name('wadmin::transaction.upadmin.get');
        $router->get('update-transaction-amount','TransactionController@updateAmountTran')
            ->name('wadmin::transaction.upamount.get');

    });
});

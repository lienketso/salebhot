<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'accountant';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        //kế toán yêu cầu đi tiền cho nhà phân phối
        $router->get('accountant-check','AccountantController@accountantCheck')
            ->name('wadmin::accountant-check.get')->middleware('permission:accountant_check');
        //gửi yêu cầu
        $router->get('accountant-withdraw-post/{id}','AccountantController@requestAdmin')
            ->name('wadmin::accountant-withdraw.post')->middleware('permission:accountant_check');
        //gửi nhiều yêu cầu
        $router->post('accountant-request-all','AccountantController@requestAll')
            ->name('wadmin::accountant.request-all.post')->middleware('permission:accountant_check');
        //Danh sách xác nhận chuyển tiền
        $router->get('accountant-confirm-bank','AccountantController@getConfirmBank')
            ->name('wadmin::accountant-confirm-bank.get')->middleware('permission:accountant_check');
        //kế toán xác nhận đã đi tiền
        $router->get('accountant-transferred/{id}','AccountantController@postConfirmBank')
            ->name('wadmin::accountant-transferred.get')->middleware('permission:accountant_transferred');
        //Xác nhận đã đi tiền nhanh
        $router->post('accountant-transferred-all','AccountantController@postTransferredAll')
            ->name('wadmin::accountant-transferred-all.post')->middleware('permission:accountant_transferred');
        //Danh sách đã bank tiền thành công
        $router->get('transferred-company','AccountantController@getTransferred')
            ->name('wadmin::transferred-company.get')->middleware('permission:accountant_transferred');

    });
});

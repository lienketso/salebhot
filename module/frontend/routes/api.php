<?php

use Illuminate\Support\Facades\Route;

Route::get('create-newsletter','HomeController@createNewletter')->name('ajax.newsletter.get');
Route::get('create-partner','HomeController@createPartner')->name('ajax.create.partner.get');
Route::post('booking-car','HomeController@postBooking')->name('ajax.create.booking.get');

//customer
Route::get('update-profile','CustomerController@updateProfile')->name('ajax.update-profile.get');
Route::post('user-update-avatar','CustomerController@updateAvatar')->name('ajax.update-avatar.get');
Route::post('user-request-money','CustomerController@requestMoney')->name('ajax.request-money.post');

//app api

Route::post('post-booking-app','ApiController@postBookingApi')->name('api.post-booking');

//home customer api
Route::get('get-revenua-customer','ApiController@getRevenua')
    ->name('api.get-revenua-customer')->middleware('authbasic');
//Số đơn hàng theo trạng thái
Route::get('get-transaction-by-status','ApiController@getTransactionByStatus')
    ->name('api.get-transaction-status')->middleware('authbasic');
//Đơn hàng mới nhất
Route::get('get-transaction-related','ApiController@getNewTransaction')
    ->name('api.get-related-transaction')->middleware('authbasic');
//Hoa hồng tháng
Route::get('get-commission-month','ApiController@totalCommission')
    ->name('api.get-commission-month')->middleware('authbasic');
//Danh sách đơn hàng theo trạng thái
Route::get('get-transaction-list-status','ApiController@getListTransaction')
    ->name('api.get-transaction-list')->middleware('authbasic');
//post booking đại lý
Route::post('post-booking-service','ApiController@postBookingDaily')
    ->name('api.post-booking-service')->middleware('authbasic');
//Lấy thông tin người dùng
Route::get('get-user-infor','ApiController@getUserInfor')
    ->name('api.get-user-infor')->middleware('authbasic');

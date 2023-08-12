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


<?php

use Illuminate\Support\Facades\Route;

Route::get('create-newsletter','HomeController@createNewletter')->name('ajax.newsletter.get');
Route::get('create-partner','HomeController@createPartner')->name('ajax.create.partner.get');
Route::post('booking-car','HomeController@postBooking')->name('ajax.create.booking.get');

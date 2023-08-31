<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

Route::get('get-company-name','ApiCompanyController@getCompany')->name('api-get-company');

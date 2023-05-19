<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$moduleRoute = 'media';

Route::group(['prefix' => $moduleRoute], function(Router $router) use ($moduleRoute) {
    $router->post('upload-media', 'ApiMediaController@uploadmutil')->name('ajax.media.product.get');
    $router->post('upload-media-muti', 'ApiMediaController@store')->name('ajax.media.muti.get');
    $router->post('delete-media', 'ApiMediaController@delete')->name('ajax.media.delete.get');
});

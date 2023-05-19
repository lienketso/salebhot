<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$moduleRoute = 'category';

Route::group(['prefix' => $moduleRoute], function(Router $router) use ($moduleRoute) {
    $router->get('update-sort', 'ApiCategoryController@updatesort')->name('ajax.order.get');
    $router->get('update-parent', 'ApiCategoryController@updateparent')->name('ajax.parent.get');
});

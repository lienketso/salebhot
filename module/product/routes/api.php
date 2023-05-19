<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$moduleRoute = 'cat';
$productRoute = 'product';

Route::group(['prefix' => $moduleRoute], function(Router $router) use ($moduleRoute) {
    $router->get('update-cat-sort', 'ApiCatproductController@updatesort')->name('ajax.cat.order.get');
    $router->get('update-cat-parent', 'ApiCatproductController@updateparent')->name('ajax.cat.parent.get');
});

Route::group(['prefix' => $productRoute], function(Router $router) use ($productRoute) {
    $router->get('get-company', 'ApiProductController@getCompany')->name('ajax.product.company.get');
    $router->get('ajax-create-option', 'ApiProductController@ajaxCreateOption')->name('ajax.product.option.create');
    $router->get('ajax-remove-option', 'ApiProductController@ajaxRemoveOption')->name('ajax.product.option.remove');
    $router->get('ajax-create-option-value', 'ApiProductController@ajaxCreateOptionValue')->name('ajax.option.value.create');
    $router->get('ajax-remove-option-value', 'ApiProductController@ajaxRemoveOptionValue')->name('ajax.option.value.remove');

    $router->get('ajax-post-add-variant','ApiProductController@postVariant')->name('ajax.option.variant.add');
    $router->get('ajax-get-edit-variant','ApiProductController@getEditVariant')->name('ajax.option.variant.edit');
    $router->get('ajax-get-remove-sku','ApiProductController@getRemoveSku')->name('ajax.option.sku.remove');

});


<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'setting';
$linkRoute = 'links';
$searchRoute = 'search';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','SettingController@getIndex')
            ->name('wadmin::setting.index.get')->middleware('permission:setting_index');
        $router->post('index','SettingController@postIndex')
            ->name('wadmin::setting.index.post')->middleware('permission:setting_index');
        $router->get('fact','SettingController@getFact')
            ->name('wadmin::setting.fact.get')->middleware('permission:setting_fact');
        $router->post('fact','SettingController@postFact')
            ->name('wadmin::setting.fact.post')->middleware('permission:setting_fact');
        $router->get('keyword','SettingController@getKeyword')
            ->name('wadmin::setting.keyword.get')->middleware('permission:setting_keyword');
        $router->post('keyword','SettingController@postKeyword')
            ->name('wadmin::setting.keyword.post')->middleware('permission:setting_keyword');
        $router->get('about','SettingController@getAbout')
            ->name('wadmin::setting.about.get')->middleware('permission:setting_about');
        $router->post('about','SettingController@postAbout')
            ->name('wadmin::setting.about.post')->middleware('permission:setting_about');
    });
});


Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$linkRoute){
    $router->group(['prefix'=>$linkRoute],function(Router $router) use ($adminRoute,$linkRoute){
        $router->get('index','LinksController@getIndex')
            ->name('wadmin::link.index.get');
        $router->get('create-links','LinksController@getCreate')->name('wadmin::link.create.get');
        $router->post('create-links','LinksController@postCreate')->name('wadmin::link.create.post');
        $router->get('edit-links/{id}','LinksController@getEdit')->name('wadmin::link.edit.get');
        $router->post('edit-links/{id}','LinksController@postEdit')->name('wadmin::link.edit.post');
        $router->get('delete-links/{id}','LinksController@delete')->name('wadmin::link.delete.get');
    });
});


Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$searchRoute){
    $router->group(['prefix'=>$searchRoute],function(Router $router) use ($adminRoute,$searchRoute){
        $router->get('index','SearchController@getIndex')
            ->name('wadmin::search.index.get');
        $router->get('create-search','SearchController@getCreate')->name('wadmin::search.create.get');
        $router->post('create-search','SearchController@postCreate')->name('wadmin::search.create.post');
        $router->get('edit-search/{id}','SearchController@getEdit')->name('wadmin::search.edit.get');
        $router->post('edit-search/{id}','SearchController@postEdit')->name('wadmin::search.edit.post');
        $router->get('delete-search/{id}','SearchController@delete')->name('wadmin::search.delete.get');
    });
});

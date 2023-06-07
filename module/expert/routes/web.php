<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'expert';

Route::group(['prefix'=>$adminRoute],function(Router $router) use($adminRoute,$moduleRoute){
    $router->group(['prefix'=>$moduleRoute],function(Router $router) use ($adminRoute,$moduleRoute){
        $router->get('index','ExpertController@getIndex')
            ->name('wadmin::expert.index.get')->middleware('permission:expert_index');
        $router->get('pending','ExpertController@getPending')
            ->name('wadmin::expert.pending.get')->middleware('permission:expert_index');
        $router->get('create','ExpertController@getCreate')
            ->name('wadmin::expert.create.get')->middleware('permission:expert_create');
        $router->post('create','ExpertController@postCreate')
            ->name('wadmin::expert.create.post')->middleware('permission:expert_create');
        $router->get('edit/{id}','ExpertController@getEdit')
            ->name('wadmin::expert.edit.get')->middleware('permission:expert_edit');
        $router->post('edit/{id}','ExpertController@postEdit')
            ->name('wadmin::expert.edit.post')->middleware('permission:expert_edit');
        $router->get('remove/{id}','ExpertController@remove')
            ->name('wadmin::expert.remove.get')->middleware('permission:expert_delete');
        $router->get('change/{id}','ExpertController@changeStatus')
            ->name('wadmin::expert.change.get');
        //revenue
        $router->get('revenue','ExpertController@revenue')
            ->name('wadmin::expert.revenue.get')->middleware('permission:expert_revenue');
    });
});

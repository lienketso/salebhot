<?php


namespace Product\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use Product\Repositories\CatproductRepository;

class ApiCatproductController extends BaseController
{
    protected $model;
    public function __construct(CatproductRepository $catproductRepository)
    {
        $this->model = $catproductRepository;
    }

    public function updatesort(Request $request){
        $id = $request->get('id');
        $newsort = $request->get('newsort');
        $data['sort_order'] = $newsort;
        $this->model->update($data,$id);
        return '200';
    }
    public function updateparent(Request $request){
        $id = $request->get('id');
        $parent = $request->get('parent');
        $data['parent'] = $parent;
        $this->model->update($data,$id);
        return '200';
    }

}

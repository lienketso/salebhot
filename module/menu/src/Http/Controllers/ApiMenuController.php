<?php


namespace Menu\Http\Controllers;
use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Category\Repositories\CategoryRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ApiMenuController extends BaseController
{
    protected $model;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->model = $categoryRepository;
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

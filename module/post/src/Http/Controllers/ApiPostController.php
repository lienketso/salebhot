<?php

namespace Post\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Category\Models\CategoryMeta;
use Category\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class ApiPostController extends BaseController
{
    protected $model;
    public function __construct(Request $request, CategoryRepository $categoryRepository)
    {
        $this->model = $categoryRepository;
    }
    public function changeCategory(Request $request){
        $id = $request->get('id');
        $categoryMeta = CategoryMeta::where('category',$id)->first();
        if(!empty($categoryMeta)){
            $category = $categoryMeta->meta_value;
        }else{
            $category = '';
        }

        return $category;
    }
}

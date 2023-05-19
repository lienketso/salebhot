<?php


namespace Frontend\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use Product\Repositories\CatproductRepository;

class CategoryController extends BaseController
{
    protected $model;
    protected $lang;
    public function __construct(CatproductRepository $catproductRepository)
    {
        $this->model = $catproductRepository;
        $this->lang = session('lang');
    }

    public function index(){
        $data = $this->model->scopeQuery(function ($e){
            return $e->orderBy('sort_order','asc')
                ->where('status','active')
                ->where('lang_code',$this->lang);
        })->paginate(16);

        return view('frontend::category.index',['data'=>$data]);
    }

}

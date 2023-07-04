<?php


namespace Frontend\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use Media\Models\Media;
use Product\Models\Catproduct;
use Product\Models\Product;
use Product\Repositories\CatproductRepository;
use Product\Repositories\ProductRepository;

class ProductController extends BaseController
{
    protected $model;
    protected $lang;
    protected $cat;
    public function __construct(ProductRepository $productRepository, CatproductRepository $catproductRepository)
    {
        $this->model = $productRepository;
        $this->lang = session('lang');
        $this->cat = $catproductRepository;
    }

    public function index(Request $request){

        $q = Product::query();

        $data = $q->where('status','active')
            ->where('lang_code',$this->lang)
            ->paginate(20);

        //end cấu hình thẻ meta

        return view('frontend::customer.products.index',[
            'data'=>$data
        ]);
    }

    public function checkout($id){
        $data = $this->model->find($id);
        $category = $this->cat->findWhere(['status'=>'active','lang_code'=>$this->lang])->all();
       return view('frontend::customer.products.checkout',compact('data','category'));
    }

    function search(Request $request){
        $name = $request->get('keyword');
        $q = Product::query();

        if (!is_null($name))
        {
            $q = $q->where('name','LIKE', '%'.$name.'%');
        }

        $data = $q->orderBy('created_at','desc')
            ->where('lang_code',$this->lang)
            ->where('main_display',1)
            ->where('status','active')->paginate(15);

        $allCategory = $this->cat->orderBy('sort_order','asc')->findWhere(['status'=>1,'lang_code'=>$this->lang])->all();
        $countProduct = $this->model->findWhere(['lang_code'=>$this->lang,'status'=>'active'])->count();
        return view('frontend::product.search',[
            'data'=>$data,
            'allCategory'=>$allCategory,
            'countProduct'=>$countProduct,
            'name'=>$name
        ]);
    }

}

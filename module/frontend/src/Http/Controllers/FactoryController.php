<?php


namespace Frontend\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use Product\Repositories\FactoryRepository;
use Product\Repositories\ProductRepository;

class FactoryController extends BaseController
{
    protected $model;
    protected $lang;
    protected $pro;
    public function __construct(FactoryRepository $factoryRepository, ProductRepository $productRepository)
    {
        $this->model = $factoryRepository;
        $this->pro = $productRepository;
        $this->lang = session('lang');
    }

    public function index(){
        $data = $this->model->scopeQuery(function($e){
            return $e->orderBy('sort_order','asc')
                ->where('status','active')
                ->where('lang_code',$this->lang);
        })->paginate(10);

        return view('frontend::factory.index',['data'=>$data]);
    }

    public function detail($slug){
        $data = $this->model->findWhere(['slug'=>$slug])->first();

        //cấu hình các thẻ meta
        $meta_title = $data->meta_title;
        $meta_desc = cut_string($data->meta_desc,190);
        $meta_url = route('frontend::factory.detail.get',$data->slug);
        if($data->thumbnail!=''){
            $meta_thumbnail = upload_url($data->thumbnail);
        }else{
            $meta_thumbnail = public_url('admin/themes/images/no-image.png');
        }
        view()->composer('frontend:*', function($view) use ($meta_title,$meta_desc,$meta_url,$meta_thumbnail){
            $view->with(['meta_title'=>$meta_title,'meta_desc'=>$meta_desc,'meta_url'=>$meta_url,'meta_thumbnail'=>$meta_thumbnail]);
        });
        //end cấu hình thẻ meta
        $productByFac = $this->pro->scopeQuery(function ($e) use ($data){
            return $e->orderBy('created_at','desc')
                ->where('status','active')
                ->where('lang_code',$this->lang)
                ->where('factory_id',$data->id);
        })->paginate(12);

        $related = $this->model->scopeQuery(function ($e) use ($data){
            return $e->orderBy('created_at','desc')
                ->where('status','active')
                ->where('lang_code',$this->lang)
                ->where('id','!=',$data->id);
        })->limit(3);

        return view('frontend::factory.detail',[
            'data'=>$data,
            'productByFac'=>$productByFac,
            'related'=>$related
        ]);

    }

}

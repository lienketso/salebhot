<?php


namespace Frontend\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Company\Models\Company;
use Company\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Product\Repositories\CatproductRepository;
use Product\Repositories\ProductRepository;

class CompanyController extends BaseController
{
    protected $model;
    protected $lang;
    protected $cat;
    public function __construct(CompanyRepository $companyRepository, CatproductRepository $catproductRepository)
    {
        $this->model = $companyRepository;
        $this->lang = session('lang');
        $this->cat = $catproductRepository;
    }

    public function index(Request $request){

            $name = $request->get('name');
            $city = $request->get('city');
            $category = $request->get('category');
            $sort_order = $request->get('sort_order');
            //filter if isset request
            $q = Company::query();
            if (!is_null($name))
            {
                $q = $q->where('name','LIKE', '%'.$name.'%');
            }
            if (!is_null($city))
            {
                $q = $q->where('city','LIKE', '%'.$city.'%');
            }
            if (!is_null($category))
            {
                $q = $q->whereHas('category', function ($e) use ($category){
                    return $e->where('cat_id',$category);
                });
            }

            $sort_name = 'created_at';
            $sort_by = 'desc';
            if (!is_null($sort_order))
            {
                if($sort_order==2){
                    $sort_name = 'count_view';
                    $sort_by = 'asc';
                }
            }

            $data = $q->orderBy($sort_name,$sort_by)
                ->where('lang_code',$this->lang)
                ->where('status','active')->paginate(12);

        $countCompany = $this->model->findWhere(['lang_code'=>$this->lang,'status'=>'active'])->count();
        $allCategory = $this->cat->orderBy('sort_order','asc')->findWhere(['status'=>1,'lang_code'=>$this->lang])->all();
        return view('frontend::company.index',['countCompany'=>$countCompany,'allCategory'=>$allCategory,'data'=>$data]);
    }

    public function detail($slug,ProductRepository $productRepository){
        $data = $this->model->findWhere(['slug'=>$slug])->first();
        $productList = $productRepository->findWhere(['company_id'=>$data->id,'status'=>1])->all();
        //doanh nghiệp tương tự
        $semilarCompany = $this->model->whereHas('category',function ($e) use($data){
            return $e->where('cat_id',$data->id);
        })->limit(4);

        //update count view
        $input['count_view'] = $data->count_view+1;
        $this->model->update($input,$data->id);
        //end update count view

        //cấu hình các thẻ meta
        $meta_title = $data->meta_title;
        $meta_desc = cut_string($data->meta_desc,190);
        $meta_url = route('frontend::company.detail.get',$data->slug);
        if($data->thumbnail!=''){
            $meta_thumbnail = upload_url($data->thumbnail);
        }else{
            $meta_thumbnail = public_url('admin/themes/images/no-image.png');
        }
        view()->composer('frontend:*', function($view) use ($meta_title,$meta_desc,$meta_url,$meta_thumbnail){
            $view->with(['meta_title'=>$meta_title,'meta_desc'=>$meta_desc,'meta_url'=>$meta_url,'meta_thumbnail'=>$meta_thumbnail]);
        });
        //end cấu hình thẻ meta

        return view('frontend::company.detail',['data'=>$data,'productList'=>$productList,'semilarCompany'=>$semilarCompany]);
    }
}

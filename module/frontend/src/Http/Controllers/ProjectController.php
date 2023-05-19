<?php


namespace Frontend\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use Post\Repositories\PostRepository;

class ProjectController extends BaseController
{
    protected $lang;
    protected $model;
    public function __construct(PostRepository $postRepository)
    {
        $this->model = $postRepository;
        $this->lang = session('lang');
    }

    public function index(){
        $data = $this->model->scopeQuery(function ($e){
            return $e->orderBy('created_at','desc')
                ->where('status','active')
                ->where('lang_code',$this->lang)
                ->where('post_type','project');
        })->paginate(12);
        return view('frontend::project.index',['data'=>$data]);
    }

    public function detail($slug){
        $data = $this->model->findWhere(['slug'=>$slug])->first();

        $related = $this->model->scopeQuery(function($e) use ($data){
            return $e->orderBy('created_at','desc')
                ->where('id','!=',$data->id)
                ->where('status','active')
                ->where('post_type','project')
                ->where('lang_code',$this->lang);
        })->limit(6);
        //cấu hình các thẻ meta
        $meta_title = $data->meta_title;
        $meta_desc = cut_string($data->meta_desc,190);
        $meta_url = route('frontend::solution.index.get',$data->slug);
        if($data->thumbnail!=''){
            $meta_thumbnail = upload_url($data->thumbnail);
        }else{
            $meta_thumbnail = public_url('admin/themes/images/no-image.png');
        }
        view()->composer('frontend:*', function($view) use ($meta_title,$meta_desc,$meta_url,$meta_thumbnail){
            $view->with(['meta_title'=>$meta_title,'meta_desc'=>$meta_desc,'meta_url'=>$meta_url,'meta_thumbnail'=>$meta_thumbnail]);
        });
        //end cấu hình thẻ meta

        //update count view
        $input['count_view'] = $data->count_view+1;
        $this->model->update($input,$data->id);
        //end update count view
        return view('frontend::project.detail',['data'=>$data,'related'=>$related]);
    }

}

<?php


namespace Frontend\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Category\Models\CategoryMeta;
use Category\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Post\Models\Post;
use Post\Models\PostMeta;
use Post\Repositories\PostRepository;
use Illuminate\Support\Carbon;

class BlogController extends BaseController
{
    protected $model;
    protected $cat;
    protected $lang;
    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $this->model = $postRepository;
        $this->cat = $categoryRepository;
        $this->lang = session('lang');
    }

    public function page($slug){
        $data = $this->model->getSinglePost($slug);

        //cấu hình các thẻ meta
        $meta_title = $data->meta_title;
        $meta_desc = cut_string($data->meta_desc,190);
        $meta_url = route('frontend::page.index.get',$data->slug);
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

        $related = $this->model->scopeQuery(function ($e) use ($data){
            return $e->orderBy('created_at','desc')
                ->where('post_type','page')
                ->where('status','active')
                ->where('lang_code',$this->lang)
                ->where('id','!=',$data->id);
        })->limit(6);

        return view('frontend::blog.page',[
            'data'=>$data,
            'related'=>$related
        ]);
    }

    public function index($slug, Request $request){
        $data = $this->cat->with(['childs'])->findWhere(['slug'=>$slug])->first();
        $ids = [$data->id];
        if(count($data->childs)){
            foreach($data->childs as $child){
                $ids[] = $child->id;
            }
        }
        $q = Post::query();
        $input = $request->all();
        if(!is_null($input)){
            foreach($input as $i){
//                $q->whereHas('meta', function ($e) use ($i) {
//                    $e->where('meta_value->name', 'LIKE', '%'.$i.'%');
//                });
                $q->with(['meta'=>function($e) use($i){
                    $e->where('name','LIKE','%'.$i.'%');
                }]);
            }
        }

        $post = $q->orderBy('created_at','desc')
                ->whereIn('category',$ids)
            ->where('status','active')
            ->paginate(10);

        //cấu hình các thẻ meta
        $meta_title = $data->meta_title;
        $meta_desc = cut_string($data->meta_desc,190);
        $meta_url = route('frontend::blog.index.get',$data->slug);
        if($data->thumbnail!=''){
            $meta_thumbnail = upload_url($data->thumbnail);
        }else{
            $meta_thumbnail = public_url('admin/themes/images/no-image.png');
        }
        $formSearch = CategoryMeta::where('category',$data->id)->where('status','active')->first();
        view()->composer('frontend:*', function($view) use ($meta_title,$meta_desc,$meta_url,$meta_thumbnail){
            $view->with(['meta_title'=>$meta_title,'meta_desc'=>$meta_desc,'meta_url'=>$meta_url,'meta_thumbnail'=>$meta_thumbnail]);
        });
        //end cấu hình thẻ meta

        return view('frontend::blog.index',[
            'data'=>$data,
            'post'=>$post,
            'formSearch'=>$formSearch
        ]);
    }

    public function detail($slug){
        $data = $this->model->getSinglePost($slug);
        $catInfo = $this->cat->findWhere(['id'=>$data->category])->first();
        //bài viết liên quan

        $related = $this->model->scopeQuery(function ($e) use ($catInfo,$data){
            return $e->orderBy('created_at','desc')
                ->where('id','!=',$data->id)
                ->where('category',$catInfo->id);
        })->limit(6);

        //category
        $listCat = $this->cat->orderBy('sort_order','asc')
            ->findWhere(['lang_code'=>$this->lang,'status'=>'active','parent'=>0])->all();
        //meta box
        $metaPost = PostMeta::where('post_id',$data->id)->get();
        //cấu hình các thẻ meta
        $meta_title = $data->meta_title;
        $meta_desc = cut_string($data->meta_desc,190);
        $meta_url = route('frontend::blog.index.get',$data->slug);
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

        $prevPost = Post::where('id','<',$data->id)
            ->where('lang_code',$this->lang)
            ->where('post_type','blog')
            ->where('category',$data->category)->first();
        $nextPost = Post::where('id','>',$data->id)
            ->where('lang_code',$this->lang)
            ->where('post_type','blog')
            ->where('category',$data->category)->first();


        return view('frontend::blog.detail',[
            'data'=>$data,
            'metaPost'=>$metaPost,
            'catInfo'=>$catInfo,
            'related'=>$related,
            'listCat'=>$listCat,
            'prevPost'=>$prevPost,
            'nextPost'=>$nextPost
        ]);
    }

}

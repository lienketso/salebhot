<?php


namespace Post\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Category\Models\CategoryMeta;
use Category\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Post\Http\Requests\PostCreateRequest;
use Post\Http\Requests\PostEditRequest;
use Post\Models\Post;
use Post\Models\PostMeta;
use Post\Repositories\PostRepository;
use Setting\Repositories\SettingRepositories;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Users\Models\Users;

class PostsController extends BaseController
{
    protected $model;
    protected $cat;
    protected $langcode;
    protected $set;
    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository, SettingRepositories  $settingRepositories)
    {
        $this->model = $postRepository;
        $this->cat = $categoryRepository;
        $this->set = $settingRepositories;
        $this->langcode = session('lang');
    }

    public function getIndex(Request $request){
        $id = $request->get('id');
        $name = $request->get('name');
        $category_id = $request->get('category');
        $user_post = $request->get('user_post');
        $userLog = Auth::user();
        $roles = $userLog->load('roles.perms');
        $permissionPost = $roles->roles->first()->perms;
        $q = Post::query();

        if(!is_null($id)){
            $q->where('id',$id);
        }
        if(!is_null($name)){
            $q->where('name','LIKE','"%'.$name.'%"');
        }
        if(!is_null($category_id)){
            $q->where('category',$category_id);
        }
        if(!is_null($user_post)){
            $q->where('user_post',$user_post);
        }
        $data = $q->where('lang_code',$this->langcode)
            ->where('post_type','blog')
            ->orderBy('created_at','desc')
            ->paginate(20);

        $category = $this->cat->orderBy('created_at','desc')
            ->findWhere(['lang_code'=>$this->langcode,'type'=>'blog'])->all();
        $userPost = Users::where('status','active')->get();
        return view('wadmin-post::index',['data'=>$data,'permissionPost'=>$permissionPost,'category'=>$category,'userPost'=>$userPost]);
    }
    public function getCreate(){
        $catmodel = $this->cat;
        $userLog = Auth::user();
        $data = new Post();
        $postModel = $this->model;
        $roles = $userLog->load('roles.perms');
        $setting = $this->set;
        $permissionPost = $roles->roles->first()->perms;
        $lang = $this->langcode;
        $catMeta = CategoryMeta::all();
        return view('wadmin-post::create',[
            'catmodel'=>$catmodel,
            'permissionPost'=>$permissionPost,
            'data'=>$data,
            'postModel'=>$postModel,
            'setting'=>$setting,
            'lang'=>$lang,
            'catMeta'=>$catMeta
        ]);
    }
    public function postCreate(PostCreateRequest $request){
        try{
            $input = $request->except(['_token','continue_post']);
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['post_type'] = 'blog';
            $input['slug'] = $request->name;
            $input['user_post'] = Auth::id();
            $input['lang_code'] = $this->langcode;
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
            $data = $this->model->create($input);

            //set meta for post
            if(!is_null($request->meta)){
                $arr = [];
                foreach($request->meta as $key=>$m){
                    $arr += [$key=>json_encode($m,JSON_UNESCAPED_UNICODE)];
                }
                $this->model->setMeta($arr,$data->id);
            }

            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::post.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::post.index.get',['id'=>$data->id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }

    }

    function getEdit($id){
        $data = $this->model->find($id);
        $catmodel = $this->cat;
        $userLog = Auth::user();
        $roles = $userLog->load('roles.perms');
        $permissionPost = $roles->roles->first()->perms;
        $lang = $this->langcode;
        $setting = $this->set;
        $postModel = $this->model;
        $catMeta = CategoryMeta::all();
        return view('wadmin-post::edit',[
            'data'=>$data,
            'catmodel'=>$catmodel,
            'permissionPost'=>$permissionPost,
            'postModel'=>$postModel,
            'setting'=>$setting,
            'lang'=>$lang,
            'catMeta'=>$catMeta
        ]);
    }

    function postEdit($id, PostEditRequest $request){
        try{
            $input = $request->except(['_token']);
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['post_type'] = 'blog';
            $input['slug'] = $request->name;
            $input['user_edit'] = Auth::id();
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
            $update = $this->model->update($input, $id);

            //update meta for post
            if(!is_null($request->meta)){
                $arr = [];
                foreach($request->meta as $key=>$m){
                    $arr += [$key=>json_encode($m,JSON_UNESCAPED_UNICODE)];
                }
//                dd($arr);
                $this->model->updateMeta($arr,$id);
            }

            return redirect()->route('wadmin::post.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    function remove($id){
        try{
            $post = Post::find($id);
            $post->meta()->delete();
            $this->model->delete($id);
            return redirect()->back()->with('delete','Bạn vừa xóa dữ liệu !');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    public function changeStatus($id){
        $input = [];
        $data = $this->model->find($id);
        if($data->status=='active'){
            $input['status'] = 'disable';
        }elseif ($data->status=='disable'){
            $input['status'] = 'active';
        }
        $this->model->update($input,$id);
        return redirect()->back();
    }

    //sản phẩm
    public function getIndexProduct(Request $request){
        $id = $request->get('id');
        $name = $request->get('name');
        $category_id = $request->get('category');
        $user_post = $request->get('user_post');
        $q = Post::query();
        if($id){
            $q->where('id',$id);
        }
        if($name){
            $q->where('name','LIKE','"%'.$name.'%"');
        }
        if(!is_null($category_id)){
            $q->where('category',$category_id);
        }
        if(!is_null($user_post)){
            $q->where('user_post',$user_post);
        }
        $data = $q->where('lang_code',$this->langcode)
            ->where('post_type','product')
            ->orderBy('created_at','desc')->paginate(10);
        $userLog = Auth::user();
        $roles = $userLog->load('roles.perms');
        $permissionPost = $roles->roles->first()->perms;
        $category = $this->cat->orderBy('created_at','desc')
            ->findWhere(['lang_code'=>$this->langcode,'type'=>'product'])->all();
        $userPost = Users::where('status','active')->get();
        return view('wadmin-post::product.index',compact('data','permissionPost','category','userPost'));
    }

    public function getCreateProduct(){
        $catmodel = $this->cat;
        $userLog = Auth::user();
        $roles = $userLog->load('roles.perms');
        $permissionPost = $roles->roles->first()->perms;
        return view('wadmin-post::product.create',['catmodel'=>$catmodel,'permissionPost'=>$permissionPost]);
    }
    public function postCreateProduct(PostCreateRequest $request){
        try{
            $input = $request->except(['_token','continue_post']);
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['slug'] = $request->name;
            $input['user_post'] = Auth::id();
            $input['lang_code'] = $this->langcode;
            $input['post_type'] = 'product';
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
            $data = $this->model->create($input);

            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::sanpham.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::sanpham.index.get',['id'=>$data->id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }

    }

    function getEditProduct($id){
        $data = $this->model->find($id);
        $catmodel = $this->cat;
        $userLog = Auth::user();
        $roles = $userLog->load('roles.perms');
        $permissionPost = $roles->roles->first()->perms;
        $qrCode = QrCode::size(1000)->generate('https://vnctuetinh.vn/');
//        echo($qrCode);die;
        return view('wadmin-post::product.edit',['data'=>$data,'catmodel'=>$catmodel,'permissionPost'=>$permissionPost]);
    }

    function postEditProduct($id, PostEditRequest $request){
        try{
            $input = $request->except(['_token']);
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['post_type'] = 'product';
            $input['slug'] = $request->name;
            $input['user_edit'] = Auth::id();
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
            $user = $this->model->update($input, $id);
            return redirect()->route('wadmin::sanpham.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

}

<?php


namespace Page\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Page\Http\Requests\PageCreateRequest;
use Page\Http\Requests\PageEditRequest;
use Post\Repositories\PostRepository;

class PageController extends BaseController
{
    protected $model;
    protected $cat;
    protected $langcode;
    public function __construct(PostRepository $postRepository)
    {
        $this->model = $postRepository;
        $this->langcode = session('lang');
    }

    public function getIndex(Request $request){
        $id = $request->get('id');
        $name = $request->get('name');
        if($id){
            $data = $this->model->scopeQuery(function ($e) use($id){
                return $e->orderBy('id','desc')->where('id',$id)->where('post_type','page');
            })->paginate(1);
        }elseif($name){
            $data = $this->model->scopeQuery(function($e) use ($name){
                return $e->orderBy('id','desc')->where('lang_code',$this->langcode)->where('post_type','page')->where('name','LIKE','%'.$name.'%')->orWhere('email',$name);
            })->paginate(10);
        }
        else{
            $data = $this->model->orderBy('created_at','desc')->where('lang_code',$this->langcode)->where('post_type','page')->paginate(10);
        }
        $userLog = Auth::user();
        $roles = $userLog->load('roles.perms');
        $permissionPost = $roles->roles->first()->perms;
        return view('wadmin-page::index',['data'=>$data,'permissionPost'=>$permissionPost]);
    }
    public function getCreate(){
        $userLog = Auth::user();
        $roles = $userLog->load('roles.perms');
        $permissionPost = $roles->roles->first()->perms;
        return view('wadmin-page::create',compact('permissionPost'));
    }
    public function postCreate(PageCreateRequest $request){
        try{
            $input = $request->except(['_token','continue_post']);
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['banner'] = replace_thumbnail($input['banner']);

            $input['lang_code'] = $this->langcode;
            $input['slug'] = $request->name;
            $input['post_type'] = $request->get('post_type');
            $input['user_post'] = Auth::id();
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
                    ->route('wadmin::page.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::page.index.get',['id'=>$data->id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }

    }

    function getEdit($id){
        $data = $this->model->find($id);
        $userLog = Auth::user();
        $roles = $userLog->load('roles.perms');
        $permissionPost = $roles->roles->first()->perms;
        return view('wadmin-page::edit',['data'=>$data,'permissionPost'=>$permissionPost]);
    }

    function postEdit($id, PageEditRequest $request){
        try{
            $input = $request->except(['_token']);

            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['banner'] = replace_thumbnail($input['banner']);
            $input['slug'] = $request->name;
            $input['user_edit'] = Auth::id();
            $input['post_type'] = 'page';
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
            $user = $this->model->update($input, $id);
            return redirect()->route('wadmin::page.index.get',['post_type'=>'page'])->with('edit','Bạn vừa cập nhật dữ liệu');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    function remove($id){
        try{
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

}

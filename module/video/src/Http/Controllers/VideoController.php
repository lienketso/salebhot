<?php


namespace Video\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Video\Http\Requests\VideoCreateRequest;
use Video\Http\Requests\VideoEditRequest;
use Post\Repositories\PostRepository;

class VideoController extends BaseController
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
                return $e->orderBy('id','desc')->where('id',$id)->where('post_type','video');
            })->paginate(1);
        }elseif($name){
            $data = $this->model->scopeQuery(function($e) use ($name){
                return $e->orderBy('id','desc')->where('lang_code',$this->langcode)
                    ->where('post_type','video')->where('name','LIKE','%'.$name.'%')->orWhere('email',$name);
            })->paginate(10);
        }
        else{
            $data = $this->model->orderBy('created_at','desc')->where('lang_code',$this->langcode)->where('post_type','video')->paginate(10);
        }

        return view('wadmin-video::index',['data'=>$data]);
    }
    public function getCreate(){
        return view('wadmin-video::create');
    }
    public function postCreate(VideoCreateRequest $request){
        try{
            $input = $request->except(['_token','continue_post']);
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['description'] = youtubeToembed($request->description);
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
                    ->route('wadmin::video.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::video.index.get',['id'=>$data->id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }

    }

    function getEdit($id){
        $data = $this->model->find($id);
        return view('wadmin-video::edit',['data'=>$data]);
    }

    function postEdit($id, VideoEditRequest $request){
        try{
            $input = $request->except(['_token']);

            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['description'] = youtubeToembed($request->description);
            $input['slug'] = $request->name;
            $input['user_edit'] = Auth::id();
            $input['post_type'] = 'video';
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
            $user = $this->model->update($input, $id);
            return redirect()->route('wadmin::video.index.get',['post_type'=>'video'])->with('edit','Bạn vừa cập nhật dữ liệu');
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

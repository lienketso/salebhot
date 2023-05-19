<?php


namespace Gallery\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Gallery\Http\Requests\GalleryCreateRequest;
use Gallery\Http\Requests\GalleryEditRequest;
use Gallery\Repositories\GalleryRepository;
use Illuminate\Http\Request;
use Media\Repositories\MediaRepository;

class GalleryController extends BaseController
{
    protected $model;
    protected $langcode;
    public function __construct(GalleryRepository $galleryRepository)
    {
        $this->model = $galleryRepository;
        $this->langcode = session('lang');
    }

    public function getIndex(Request $request){
        $id = $request->get('id');
        $groupid = $request->get('group');
        $name = $request->get('name');
        if($id){
            $data = $this->model->scopeQuery(function ($e) use($id){
                return $e->orderBy('id','desc')->where('id',$id);
            })->paginate(1);
        }elseif($name){
            $data = $this->model->scopeQuery(function($e) use ($name,$groupid){
                return $e->orderBy('id','desc')
                    ->where('group_id',$groupid)
                    ->where('lang_code',$this->langcode)
                    ->where('name','LIKE','%'.$name.'%');
            })->paginate(10);
        }
        else{
            $data = $this->model->orderBy('created_at','desc')
                ->where('lang_code',$this->langcode)
                ->where('group_id',$groupid)
                ->paginate(10);
        }
        return view('wadmin-gallery::index',['data'=>$data,'group_id'=>$groupid]);
    }
    public function getCreate(Request $request){
        $groupid = $request->get('group');
        return view('wadmin-gallery::create',['group_id'=>$groupid]);
    }
    public function postCreate(GalleryCreateRequest $request){
        try{
            $input = $request->except(['_token']);
//            if($request->hasFile('thumbnail')){
//                $image = $request->thumbnail;
//                $path = date('Y').'/'.date('m').'/'.date('d');
//                $newnname = time().'-'.$image->getClientOriginalName();
//                $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
//                $input['thumbnail'] = $path.'/'.$newnname;
//                $image->move('upload/'.$path,$newnname);
//            }
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['lang_code'] = $this->langcode;
            $input['group_id'] = $request->get('group');
            if(is_null($request->get('group'))){
                $input['group_id'] = 1;
            }
            
            $data = $this->model->create($input);
            
            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::gallery.create.get',['group'=>$data->group_id])
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::gallery.index.get',['group'=>$data->group_id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }

    }

    function getEdit($id){
        $data = $this->model->find($id);
        return view('wadmin-gallery::edit',['data'=>$data]);
    }

    function postEdit($id, GalleryEditRequest $request){
        try{
            $input = $request->except(['_token']);

//            if($request->hasFile('thumbnail')){
//                $image = $request->thumbnail;
//                $path = date('Y').'/'.date('m').'/'.date('d');
//                $newnname = time().'-'.$image->getClientOriginalName();
//                $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
//                $input['thumbnail'] = $path.'/'.$newnname;
//                $image->move('upload/'.$path,$newnname);
//            }
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);

            $user = $this->model->update($input, $id);
            return redirect()->route('wadmin::gallery.index.get',['group'=>$user->group_id])->with('edit','Bạn vừa cập nhật dữ liệu');
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

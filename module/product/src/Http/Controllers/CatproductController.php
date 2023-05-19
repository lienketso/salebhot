<?php


namespace Product\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Product\Http\Requests\CatCreateRequest;
use Product\Http\Requests\CatEditRequest;
use Product\Repositories\CatproductRepository;

class CatproductController extends BaseController
{
    protected $model;
    protected $langcode;
    public function __construct(CatproductRepository $catproductRepository)
    {
       $this->model = $catproductRepository;
        $this->langcode = session('lang');
    }

    public function getIndex(Request $request){
        $id = $request->get('id');
        $name = $request->get('name');
        if($id){
            $data = $this->model->scopeQuery(function ($e) use($id){
                return $e->orderBy('id','desc')->where('id',$id);
            })->paginate(1);
        }elseif($name){
            $data = $this->model->scopeQuery(function($e) use ($name){
                return $e->orderBy('id','desc')->where('name','LIKE','%'.$name.'%')->where('lang_code',$this->langcode);
            })->paginate(20);
        }
        else{
            $data = $this->model->orderBy('created_at','desc')->where('lang_code',$this->langcode)->paginate(20);
        }
        $model = $this->model;
        return view('wadmin-product::category.index',['data'=>$data,'model'=>$model]);
    }
    public function getCreate(){
        $model = $this->model;
        return view('wadmin-product::category.create',['model'=>$model]);
    }
    public function postCreate(CatCreateRequest $request){
        try{
            $input = $request->except(['_token','continue_post']);
//            if($request->hasFile('thumbnail')){
//                $image = $request->thumbnail;
//                $path = date('Y').'/'.date('m').'/'.date('d');
//                $input['thumbnail'] = $path.'/'.$image->getClientOriginalName();
//                $image->move('upload/'.$path,$image->getClientOriginalName());
//            }
//            if($request->hasFile('background')){
//                $image = $request->background;
//                $path = date('Y').'/'.date('m').'/'.date('d');
//                $input['background'] = $path.'/'.$image->getClientOriginalName();
//                $image->move('upload/'.$path,$image->getClientOriginalName());
//            }
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['background'] = replace_thumbnail($input['background']);
            $input['slug'] = $request->name;
            $input['lang_code'] = $this->langcode;
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            $data = $this->model->create($input);

            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::cat.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::cat.index.get',['id'=>$data->id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }

    }

    function getEdit($id){
        $data = $this->model->find($id);
        $model = $this->model;
        return view('wadmin-product::category.edit',['data'=>$data,'model'=>$model]);
    }

    function postEdit($id, CatEditRequest $request){
        try{
            $input = $request->except(['_token']);

//            if($request->hasFile('thumbnail')){
//                $image = $request->thumbnail;
//                $path = date('Y').'/'.date('m').'/'.date('d');
//                $input['thumbnail'] = $path.'/'.$image->getClientOriginalName();
//                $image->move('upload/'.$path,$image->getClientOriginalName());
//            }
//            if($request->hasFile('background')){
//                $image = $request->background;
//                $path = date('Y').'/'.date('m').'/'.date('d');
//                $input['background'] = $path.'/'.$image->getClientOriginalName();
//                $image->move('upload/'.$path,$image->getClientOriginalName());
//            }
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['background'] = replace_thumbnail($input['background']);
            $input['slug'] = $request->name;
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            $cat= $this->model->update($input, $id);
            return redirect()->route('wadmin::cat.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
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

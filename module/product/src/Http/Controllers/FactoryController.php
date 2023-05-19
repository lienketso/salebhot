<?php


namespace Product\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use Product\Http\Requests\FactoryCreateRequest;
use Product\Repositories\FactoryRepository;

class FactoryController extends BaseController
{
    protected $model;
    protected $langcode;
    public function __construct(FactoryRepository $factoryRepository)
    {
        $this->model = $factoryRepository;
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
            })->paginate(10);
        }
        else{
            $data = $this->model->orderBy('created_at','desc')
                ->where('lang_code',$this->langcode)->paginate(10);
        }

        return view('wadmin-product::factory.index',['data'=>$data,'langcode'=>$this->langcode]);
    }
    public function getCreate(){
        return view('wadmin-product::factory.create');
    }
    public function postCreate(FactoryCreateRequest $request){
        try{
            $input = $request->except(['_token','continue_post']);
//            if($request->hasFile('thumbnail')){
//                $image = $request->thumbnail;
//                $path = date('Y').'/'.date('m').'/'.date('d');
//                $newnname = time().'-'.$image->getClientOriginalName();
//                $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
//                $input['thumbnail'] = $path.'/'.$newnname;
//                $image->move('upload/'.$path,$newnname);
//            }
//            if($request->hasFile('image')){
//                $image = $request->image;
//                $path = date('Y').'/'.date('m').'/'.date('d');
//                $newnname = time().'-'.$image->getClientOriginalName();
//                $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
//                $input['image'] = $path.'/'.$newnname;
//                $image->move('upload/'.$path,$newnname);
//            }
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['image'] = replace_thumbnail($input['image']);
            $input['slug'] = $request->name;
            $input['lang_code'] = $this->langcode;

            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }

            $data = $this->model->create($input);
            //upload multi file

            //continue post if click continue
            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::factory.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::factory.index.get',['id'=>$data->id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }

    }

    function getEdit($id){
        $data = $this->model->find($id);
        return view('wadmin-product::factory.edit',['data'=>$data]);
    }

    function postEdit($id, FactoryCreateRequest $request){
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
//            if($request->hasFile('image')){
//                $image = $request->image;
//                $path = date('Y').'/'.date('m').'/'.date('d');
//                $newnname = time().'-'.$image->getClientOriginalName();
//                $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
//                $input['image'] = $path.'/'.$newnname;
//                $image->move('upload/'.$path,$newnname);
//            }
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['image'] = replace_thumbnail($input['image']);
            $input['slug'] = $request->name;
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }

            $user = $this->model->update($input, $id);
            return redirect()->route('wadmin::factory.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
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

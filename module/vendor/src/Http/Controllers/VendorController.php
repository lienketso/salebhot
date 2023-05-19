<?php


namespace Vendor\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Media\Repositories\MediaRepository;
use Product\Http\Requests\ProductCreateRequest;
use Product\Http\Requests\ProductEditRequest;
use Product\Repositories\CatproductRepository;
use Product\Repositories\ProductRepository;


class VendorController extends BaseController
{
    protected $model;
    protected $cat;
    protected $langcode;
    protected $fac;
    public function __construct(ProductRepository $productRepository,CatproductRepository $catproductRepository)
    {
        $this->model = $productRepository;
        $this->cat = $catproductRepository;
        $this->langcode = session('lang');
    }

    public function getIndex(Request $request){
        $userLogin = Auth::user();
        $id = $request->get('id');
        $name = $request->get('name');
        if($id){
            $data = $this->model->scopeQuery(function ($e) use($id){
                return $e->orderBy('id','desc')->where('id',$id);
            })->paginate(1);
        }elseif($name){
            $data = $this->model->scopeQuery(function($e) use ($name,$userLogin){
                return $e->orderBy('id','desc')
                    ->where('name','LIKE','%'.$name.'%')
                    ->where('factory_id',$userLogin->factory_id)
                    ->where('lang_code',$this->langcode);
            })->paginate(10);
        }
        else{
            $data = $this->model->orderBy('created_at','desc')
                ->where('lang_code',$this->langcode)
                ->where('factory_id',$userLogin->factory_id)
                ->paginate(10);
        }
        return view('wadmin-vendor::index',['data'=>$data,'langcode'=>$this->langcode]);
    }
    public function getCreate(){
        $catmodel = $this->cat;
        $userLogin = Auth::user();
        return view('wadmin-vendor::create',['catmodel'=>$catmodel,'userLogin'=>$userLogin]);
    }
    public function postCreate(ProductCreateRequest $request, MediaRepository $mediaRepository){
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
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            $input['slug'] = $request->name;
            $input['user_post'] = Auth::id();
            $input['user_edit'] = Auth::id();
            $input['lang_code'] = $this->langcode;
            $input['count_view'] = 0;
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
            $data = $this->model->create($input);
            //upload multi file
            if ($request->hasfile('media')) {
                $files = $request->file('media');
                foreach($files as $file){
                    $path = date('Y').'/'.date('m').'/'.date('d');
                    $newnname = time().'-'.$file->getClientOriginalName();
                    $newnname = convert_vi_to_en(str_replace(' ','-',$newnname));
                    $file->move('upload/'.$path,$newnname);
                    $media = [
                        'table'=>'product',
                        'table_id'=> $data->id,
                        'name'=> $path.'/'.$newnname ,
                        'original_name'=> $file->getClientOriginalName(),
                        'path_name'=> 'upload/'.$path.'/'.$newnname
                    ];
                    $mediaRepository->create($media);
                }
            }
            //continue post if click continue
            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::vendor.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::vendor.index.get',['id'=>$data->id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }

    }

    function getEdit($id){
        $data = $this->model->find($id);
        $catmodel = $this->cat;
        return view('wadmin-vendor::edit',['data'=>$data,'catmodel'=>$catmodel]);
    }

    function postEdit($id, ProductEditRequest $request){
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
            $input['slug'] = $request->name;
            $input['user_edit'] = Auth::id();
            //cấu hình seo
            if($request->meta_title==''){
                $input['meta_title'] = $request->name;
            }
            if($request->meta_desc==''){
                $input['meta_desc'] = $request->description;
            }
            $product = $this->model->update($input, $id);
            return redirect()->route('wadmin::vendor.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
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

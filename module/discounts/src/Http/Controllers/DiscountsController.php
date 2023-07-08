<?php

namespace Discounts\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Discounts\Http\Requests\DiscountsCreateRequest;
use Discounts\Models\Discounts;
use Discounts\Repositories\DiscountsRepository;
use Illuminate\Http\Request;

class DiscountsController extends BaseController
{
    protected $model;
    public function __construct(DiscountsRepository $discountsRepository)
    {
        $this->model = $discountsRepository;
    }
    public function getIndex(Request $request){
        $q = Discounts::query();
        if(!is_null($request->get('id'))){
            $q->where('id',$request->get('id'));
        }
        $data = $q->orderBy('sort_order','asc')->paginate(20);
        return view('wadmin-discounts::index',compact('data'));
    }
    public function getCreate(){
        return view('wadmin-discounts::create');
    }
    public function postCreate(DiscountsCreateRequest $request){
        $input = $request->except(['_token','continue_post']);
        $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
        $input['discount_code'] = quickRandom(6);
        try{
            $data = $this->model->create($input);

            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::discounts.create.get')
                    ->with('create','Thêm dữ liệu thành công, tiếp tục thêm mới !');
            }
            return redirect()->route('wadmin::discounts.index.get',['id'=>$data->id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }

    }
    public function getEdit($id){
        $data = $this->model->find($id);
        return view('wadmin-discounts::edit',compact('data'));
    }

    public function postEdit($id,DiscountsCreateRequest $request){
        $data = $this->model->find($id);
        if(!$data){
           return redirect()->route('wadmin::discounts.index.get')->with('delete','Không tồn tại bản ghi này !');
        }
        $input = $request->except(['_token','continue_post']);
        try {
            $input['thumbnail'] = replace_thumbnail($input['thumbnail']);
            if($data->discount_code==''){
                $input['discount_code'] = quickRandom(6);
            }
            $update = $this->model->update($input,$id);
            return redirect()->route('wadmin::discounts.index.get',['id'=>$id])->with('edit','Bạn vừa cập nhật dữ liệu');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function remove($id){
        try{
            $data = $this->model->find($id);
            $this->model->delete($id);
            return redirect()->back()->with('delete','Bạn vừa xóa dữ liệu !');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

}

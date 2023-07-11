<?php

namespace Product\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Product\Http\Requests\SeatsCreateRequest;
use Product\Http\Requests\SeatsEditRequest;
use Product\Models\Seats;
use Product\Repositories\SeatsRepository;

class SeatsController extends BaseController
{
    protected $model;

    public function __construct(SeatsRepository $seatsRepository)
    {
        $this->model = $seatsRepository;
    }

    public function getIndex(){
        $data = $this->model->orderBy('created_at','desc')->paginate(30);
        return view('wadmin-product::seats.index',compact('data'));
    }
    public function getCreate(){
        return view('wadmin-product::seats.create');
    }
    public function postCreate(SeatsCreateRequest $request){
        $input = $request->except(['_token','continue_post']);
        try {
            $data = $this->model->create($input);
            //continue post if click continue
            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::seat.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::seat.index.get')
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }

    }

    public function getEdit($id){
        $data = $this->model->find($id);
        return view('wadmin-product::seats.edit',compact('data'));
    }

    public function postEdit($id, SeatsEditRequest $request){
        $input = $request->except(['_token','continue_post']);

        try {

            $update = $this->model->update($input,$id);
            //continue post if click continue
            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::seat.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::seat.index.get')
                ->with('edit','Sửa dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    function remove($id){
        try{
            $this->model->delete($id);
            return redirect()->back()->with('delete','Bạn vừa xóa dữ liệu !');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }



}

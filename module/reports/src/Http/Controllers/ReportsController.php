<?php

namespace Reports\Http\Controllers;

use Acl\Models\Role;
use Barryvdh\Debugbar\Controllers\BaseController;
use Commission\Models\Commission;
use Illuminate\Http\Request;

class ReportsController extends BaseController
{
    public function getIndex(){
        $q = Commission::query();
        $data = $q->orderBy('created_at','desc')->paginate(20);
        return view('wadmin-commission::index',compact('data'));
    }
    public function getCreate(){
        $roleList = Role::all();
        return view('wadmin-commission::create',compact('roleList'));
    }
    public function postCreate(Request $request){
        $input = $request->except(['_token','continue_post']);
        $validatedData = $request->validate([
            'name' => 'required',
            'commission_rate' => 'required|numeric'
        ]);
        try {
            $data = Commission::create($input);
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }

        if($request->has('continue_post')){
            return redirect()
                ->route('wadmin::commission.create.get')
                ->with('create','Thêm dữ liệu thành công');
        }
        return redirect()->route('wadmin::commission.index.get',['id'=>$data->id])
            ->with('create','Thêm dữ liệu thành công');

    }

    public function getEdit($id){
        $data = Commission::find($id);
        $roleList = Role::all();
        return view('wadmin-commission::edit',compact('data','roleList'));
    }

    public function postEdit($id, Request $request){
        $input = $request->except(['_token','continue_post']);
        $validatedData = $request->validate([
            'name' => 'required',
            'commission_rate' => 'required|numeric'
        ]);
        try {
            $update = Commission::find($id);
            $update->name = $request->name;
            $update->commission_rate = $request->commission_rate;
            $update->role_id = $request->role_id;
            $update->save();
            return redirect()->route('wadmin::commission.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

}

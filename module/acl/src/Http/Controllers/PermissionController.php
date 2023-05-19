<?php


namespace Acl\Http\Controllers;


use Acl\Repositories\PermissionRepository;
use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;

class PermissionController extends BaseController
{
    protected $model;
    public function __construct(PermissionRepository $repository)
    {
        $this->model = $repository;
    }

    public function getIndex()
    {
        $data = $this->model->orderBy('name','asc')->paginate(10);
        return view('wadmin-acl::permission.index',['data'=>$data]);
    }
    public function getCreate(){
        return view('wadmin-acl::permission.create');
    }
    public function postCreate(Request $request){
        try{
            $input = $request->except(['_token','continue_post']);
            $role = $this->model->create($input);
            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::permission.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::permission.index.get',['id'=>$role->id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    public function getEdit($id){
        $data = $this->model->find($id);
        return view('wadmin-acl::permission.edit',['data'=>$data]);
    }
    public function postEdit($id, Request $request){
        try{
            $input = $request->except(['_token']);
            $role = $this->model->update($input, $id);
            return redirect()->route('wadmin::permission.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
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

}

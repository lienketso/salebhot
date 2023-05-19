<?php


namespace Acl\Http\Controllers;


use Acl\Repositories\PermissionRepository;
use Acl\Repositories\RoleRepository;
use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    protected $model;
    protected $perm;
    public function __construct(RoleRepository $repository, PermissionRepository $permissionRepository)
    {
        $this->model = $repository;
        $this->perm = $permissionRepository;
    }

    public function getIndex()
    {
        $data = $this->model->orderBy('name','asc')->paginate(10);
        return view('wadmin-acl::role.index',['data'=>$data]);
    }
    public function getCreate(){
        $listPerm = $this->perm->orderBy('module','asc')->all();
        return view('wadmin-acl::role.create',['listPerm'=>$listPerm]);
    }
    public function postCreate(Request $request){
        try{
            $input = $request->except(['_token','continue_post']);
            $role = $this->model->create($input);
            $this->model->sync($role->id,'perms',$request->perm);
            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::role.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::role.index.get',['id'=>$role->id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    public function getEdit($id){
        $listPerm = $this->perm->orderBy('module','asc')->all();
        $data = $this->model->find($id);
        $currentPermision = $data->perms()->get()->toArray();
        $args = [];
        foreach ($currentPermision as $perm) {
            $args[] = $perm['id'];
        }
        return view('wadmin-acl::role.edit', ['data' => $data, 'listPerm' => $listPerm,'currentPermision' => $args]);
    }
    public function postEdit($id, Request $request){
        try{
            $input = $request->only(['description','display_name']);
            $role = $this->model->update($input, $id);
            $this->model->sync($id, 'perms', $request->perm);

            return redirect()->route('wadmin::role.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
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

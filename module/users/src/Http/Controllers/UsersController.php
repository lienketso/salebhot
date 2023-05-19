<?php

namespace Users\Http\Controllers;

use Acl\Repositories\RoleRepository;
use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Category\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Product\Repositories\FactoryRepository;
use Users\Http\Requests\UsersCreateRequest;
use Users\Http\Requests\UsersEditRequest;
use Users\Repositories\UsersRepository;

class UsersController extends BaseController
{
    protected $users;
    protected $cat;
    protected $langcode;
    public function __construct(UsersRepository $repository, CategoryRepository $categoryRepository)
    {
        $this->users = $repository;
        $this->cat = $categoryRepository;
        $this->langcode = session('lang');
    }

    public function getIndex(Request $request){
        $id = $request->get('id');
        $name = $request->get('name');
        if($id){
            $data = $this->users->scopeQuery(function ($e) use($id){
                return $e->orderBy('id','desc')->where('id',$id);
            })->paginate(1);
        }elseif($name){
            $data = $this->users->scopeQuery(function($e) use ($name){
                return $e->orderBy('id','desc')->where('full_name','LIKE','%'.$name.'%')->orWhere('email',$name);
            })->paginate(10);
        }
        else{
            $data = $this->users->orderBy('created_at','desc')->paginate(10);
        }

        return view('wadmin-users::index',['data'=>$data]);
    }
    public function getCreate(RoleRepository $roleRepository){
        //lấy ra role
        $listRole = $roleRepository->orderBy('name','asc')->all();
        $category = $this->cat->findWhere(['status'=>'active','lang_code'=>$this->langcode])->all();
        return view('wadmin-users::create',['listRole'=>$listRole,'category'=>$category]);
    }
    public function postCreate(UsersCreateRequest $request){
        try{
            $data = $request->except(['_token','continue_post']);
            $user = $this->users->create($data);
            $user->roles()->sync($data['role']);
            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::users.create.get')
                    ->with('create','Thêm dữ liệu thành công');
            }
            return redirect()->route('wadmin::users.index.get',['id'=>$user->id])
                ->with('create','Thêm dữ liệu thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }

    }

    function getEdit($id, RoleRepository $roleRepository){
        $data = $this->users->find($id);
        //lấy ra role
        $listRole = $roleRepository->orderBy('name','asc')->all();
        $category = $this->cat->findWhere(['status'=>'active','lang_code'=>$this->langcode])->all();

        return view('wadmin-users::edit',['data'=>$data,'listRole'=>$listRole,'category'=>$category]);
    }

    function postEdit($id, UsersEditRequest $request){
        try{
            if ($request->get('password') == null) {
                $input = $request->except(['_token', 'email', 'password', 're_password']);
            } else {
                $input = $request->except(['_token', 'email']);
            }

            if($request->hasFile('thumbnail')){
                $image = $request->thumbnail;
                $path = date('Y').'/'.date('m').'/'.date('d');
                $input['thumbnail'] = $path.'/'.$image->getClientOriginalName();
                $image->move('upload/'.$path,$image->getClientOriginalName());
            }

            $user = $this->users->update($input, $id);
            $user->roles()->sync($input['role']);
            return redirect()->route('wadmin::users.index.get')->with('edit','Bạn vừa cập nhật dữ liệu');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    function remove($id){
        try{
            $this->users->delete($id);
            return redirect()->back()->with('delete','Bạn vừa xóa dữ liệu !');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    function getProfile($id){
        $data = $this->users->find($id);
        return view('wadmin-users::profile',['data'=>$data]);
    }

    function postProfile($id, UsersEditRequest $request){
        try{
            if ($request->get('password') == null) {
                $input = $request->except(['_token', 'email', 'password', 're_password']);
            } else {
                $input = $request->except(['_token', 'email']);
            }

            if($request->hasFile('thumbnail')){
                $image = $request->thumbnail;
                $path = date('Y').'/'.date('m').'/'.date('d');
                $input['thumbnail'] = $path.'/'.$image->getClientOriginalName();
                $image->move('upload/'.$path,$image->getClientOriginalName());
            }
            $user = $this->users->update($input, $id);
            return redirect()->route('wadmin::dashboard.index.get')
                ->with('edit','Bạn vừa cập nhật thông tin tài khoản');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }


}

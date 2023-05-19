<?php


namespace App\Http\Middleware;


use Acl\Models\Permission;
use Illuminate\Contracts\Auth\Guard;
use Closure;
use Illuminate\Support\Facades\Auth;
use Route;

class AuthorizeRoute
{
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;

    }

    public function handle($request, Closure $next, $permission = NULL)
    {
        if($this->auth->guest()){
            return redirect()->route('wadmin::auth.login.get');
        }
//       1. Lấy tất cả các role của user login vào hệ thống
        $roles = $request->user()->roles()->pluck('id');
        $listRole = $request->user()->roles()->first();
//        2. Lấy tất cả các permisson khi user login vào hệ thống
        $perm = $listRole ->perms()->pluck('id');
//        3. lấy ra id của quyền truy cập
        $checkPermission = Permission::where('name',$permission)->value('id');
        //dd($perm);

//        4. Check user có được phép vào màn hình hay không
        if($perm->contains($checkPermission)){
            return $next($request);
        }else{
//            return response('Permission denied',401);
            return redirect(route('wadmin::dashboard.index.get'))->with('perm','Bạn không có quyền truy cập chức năng');
        }
//        dd($checkPermission);

   }

}

<?php

namespace Frontend\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends BaseController
{
    public function login(){
        return view('frontend::customer.login');
    }
    public function postLogin(Request $request){
//        dd($request->input());
        $check = $request->all();
        if(Auth::guard('customer')->attempt(['phone'=>$check['phone'],'password'=>$check['password'],'status'=>'active'])){
            return redirect()->route('frontend::customer.index.get');
        }else{
            return back()->with('error','Đăng nhập thất bại !');
        }
    }
    public function logout(){
        Auth::guard('customer')->logout();
        return redirect()->route('login-customer');
    }
}

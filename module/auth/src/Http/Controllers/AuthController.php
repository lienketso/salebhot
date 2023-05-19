<?php

namespace Auth\Http\Controllers;

use Auth\Http\Requests\AuthLoginRequest;
use Auth\Http\Requests\AuthRequest;
use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use Auth\Supports\Traits\Auth;

class AuthController extends BaseController
{

    use Auth;

    public function __construct()
    {
        $this->redirectTo = route('wadmin::dashboard.index.get');
        $this->redirectPath = route('wadmin::dashboard.index.get');
        $this->redirectToLoginPage = route('wadmin::auth.login.get');
    }

    public function redirectPath(){
        return redirect()->route('wadmin::auth.login.get');
    }

    public function getLogin()
    {
        return view('wadmin-auth::login');
    }

    public function postLogin(AuthLoginRequest $request)
    {
        //set default lang
        session()->put(['lang'=>config('app.locale')]);
        return $this->login(request());
    }

    public function getLogout()
    {
        $this->guard()->logout();
        session()->flush();
        session()->regenerate();
        return redirect()->to($this->redirectToLoginPage);
    }


}

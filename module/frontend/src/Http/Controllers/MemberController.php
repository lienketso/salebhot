<?php


namespace Frontend\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;

class MemberController extends BaseController
{
    function register(){
        return view('frontend::member.register');
    }
}

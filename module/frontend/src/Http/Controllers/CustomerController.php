<?php

namespace Frontend\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;

class CustomerController extends BaseController
{
    public function home(){
        return view('frontend::customer.home');
    }
}

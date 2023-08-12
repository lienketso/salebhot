<?php

namespace Frontend\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use Transaction\Repositories\TransactionRepository;

class ApiController extends BaseController
{
    protected $transaction;
    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transaction = $transactionRepository;
    }

    public function postBookingApi(Request $request){
        $input = $request->all();
        $data = $this->transaction->create($input);
        return response()->json($data);
    }
}

<?php

namespace Frontend\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Company\Models\Company;
use Company\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Transaction\Repositories\TransactionRepository;

class CustomerController extends BaseController
{
    protected $com;
    protected $user;
    protected $tran;
    public function __construct(CompanyRepository $companyRepository, TransactionRepository $transactionRepository)
    {
        $this->com = $companyRepository;
        $this->tran = $transactionRepository;
    }

    public function home(){
        $authLogin = Auth::guard('customer')->user()->id;
        $company = Company::find($authLogin);
        $month = date('m');
        $year = date('Y');
        $totalRevenue = $this->tran->scopeQuery(function ($e) use ($authLogin,$month,$year){
            return $e->where('order_status','active')
                ->where('company_id',$authLogin)
                ->whereMonth('created_at',$month)
                ->whereYear('created_at',$year);
        })->sum('amount');
        //đơn hàng hoàn thành
        $totalSuccess = $this->tran->scopeQuery(function ($query) use($authLogin,$month,$year){
            return $query->where('order_status','active')
                ->where('company_id',$authLogin)
                ->whereMonth('created_at',$month)
                ->whereYear('created_at',$year);
        })->count();
        //đơn hàng đợi duyệt
        $totalPending = $this->tran->scopeQuery(function ($query) use($authLogin,$month,$year){
            return $query->where('order_status','pending')
                ->where('company_id',$authLogin)
                ->whereMonth('created_at',$month)
                ->whereYear('created_at',$year);
        })->count();
        //đơn hàng hủy
        $totalCancel = $this->tran->scopeQuery(function ($query) use($authLogin,$month,$year){
            return $query->where('order_status','cancel')
                ->where('company_id',$authLogin)
                ->whereMonth('created_at',$month)
                ->whereYear('created_at',$year);
        })->count();
        return view('frontend::customer.home',compact('totalRevenue','totalSuccess','totalPending','totalCancel'));
    }
}

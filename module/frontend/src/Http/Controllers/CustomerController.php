<?php

namespace Frontend\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Company\Models\Company;
use Company\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Setting\Repositories\SettingRepositories;
use Transaction\Repositories\TransactionRepository;

class CustomerController extends BaseController
{
    protected $com;
    protected $user;
    protected $tran;
    protected $set;
    public function __construct(CompanyRepository $companyRepository, TransactionRepository $transactionRepository, SettingRepositories $settingRepositories)
    {
        $this->com = $companyRepository;
        $this->tran = $transactionRepository;
        $this->set = $settingRepositories;
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
        //danh sách đơn hàng mới nhất
        $transactions = $this->tran->scopeQuery(function($e) use ($authLogin){
            return $e->where('company_id',$authLogin);
        })->with('orderProduct')->limit(10);

        return view('frontend::customer.home',compact(
            'totalRevenue',
            'totalSuccess',
            'totalPending',
            'totalCancel',
            'transactions'
        ));
    }

    public function order(Request $request){
        $authId= Auth::guard('customer')->user()->id;
        $orderActive = $this->tran->scopeQuery(function ($e) use ($authId){
            return $e->orderBy('created_at','desc')->where('order_status','active')->where('company_id',$authId);
        } )->paginate(5);

        $artilces = '';
        if ($request->ajax()) {
            foreach ($orderActive as $result) {
                $artilces.='<div class="card order-box">';
                $artilces.='<div class="card-body">';
                $artilces.='<a href="'.route('frontend::customer.order-single.get',$result->id).'">';
                $artilces.='<div class="order-content">';
                $artilces.='<div class="right-content">';
                $artilces.='<h6 class="order-number">ORDER # '.$result->id.'</h6>';
                $artilces.='<ul>';
                foreach($result->orderProduct as $p) {
                    $artilces .= '<li><p class="order-name">'.$p->product->name.'</p></li>';
                }
                $artilces.='<li><h6 class="order-time">Ngày đặt: '.format_date($result->created_at).'</h6></li>';
                $artilces.='</ul>';
                $artilces.='</div>';
                $artilces.='</div>';
                $artilces.='<div class="badge badge-md badge-primary float-end rounded-sm">Xem</div>';
                $artilces.='</a>';
                $artilces.='</div>';
                $artilces.='</div>';

            }
            return $artilces;
        }

        $orderPending = $this->tran->scopeQuery(function ($e) use ($authId){
            return $e->where('order_status','pending')->where('company_id',$authId);
        })->paginate(20);

        $orderCancel = $this->tran->scopeQuery(function ($e) use ($authId){
            return $e->where('order_status','cancel')->where('company_id',$authId);
        })->paginate(20);


        return view('frontend::customer.order',compact('orderPending','orderActive','orderCancel'));
    }

    public function orderDetail(Request $request,$id){
        $data = $this->tran->find($id);
        return view('frontend::customer.order-single',compact('data'));
    }
    public function revenue(Request $request){
        $authId= Auth::guard('customer')->user()->id;
        $commissionRate  = intval($this->set->getSettingMeta('commission_rate'));
        $mon = $request->mon;
        $thang = date('m');
        $year = date('Y');
        if(!is_null($mon)){
            $thang = $mon;
        }
        $monthList = collect([]);
        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::createFromDate($year, $month, 1);
            $monthList->push([
                'value' => $date->format('m'),
                'label' => $date->format('F'),
            ]);
        }
        $totalRevenue = $this->tran->scopeQuery(function ($e) use ($thang,$year,$authId){
            return $e->where('company_id',$authId)
                ->where('order_status','active')
                ->whereMonth('created_at',$thang)
                ->whereYear('created_at',$year);
        })->sum('amount');


        $totalTransaction = $this->tran->scopeQuery(function ($e) use ($authId,$thang,$year){
            return $e->where('company_id',$authId)
                ->whereMonth('created_at',$thang)
                ->whereYear('created_at',$year);
        })->count();

        return view('frontend::customer.revenue',compact(
            'thang','year','totalRevenue','commissionRate','totalTransaction','monthList'
        ));
    }

}

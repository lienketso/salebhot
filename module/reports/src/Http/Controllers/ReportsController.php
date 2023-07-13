<?php

namespace Reports\Http\Controllers;

use Acl\Models\Role;
use Barryvdh\Debugbar\Controllers\BaseController;
use Carbon\Carbon;
use Commission\Models\Commission;
use Company\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Setting\Repositories\SettingRepositories;
use Transaction\Models\Transaction;
use Users\Models\Users;

class ReportsController extends BaseController
{

    public function experts(Request $request){
        $q = new Users();
        $mon = $request->mon;
        $thang = date('m');
        $year = date('Y');
        if(!is_null($mon)){
            $thang = $mon;
        }
        // Lấy danh sách tháng trong năm
        $monthList = collect([]);
        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::createFromDate($year, $month, 1);
            $monthList->push([
                'value' => $date->format('m'),
                'label' => $date->format('F'),
            ]);
        }
        $commission = Commission::where('role_id',6)->first();
        $commissionRate = ($commission->commission_rate / 100);

        $chuyenvien = Users::select('users.*')
            ->leftJoin('transaction', function ($join) use($thang,$year){
                $join->on('users.id','=','transaction.user_id')
                    ->where('transaction.order_status','active')
                    ->whereMonth('transaction.updated_at',$thang)
                    ->whereYear('transaction.updated_at',$year);
            })
            ->selectRaw('SUM(transaction.sub_total) as total_amount')
            ->selectRaw('SUM(transaction.price) as total_price')
            ->selectRaw('COUNT(transaction.id) as totalOrder')
            ->groupBy('users.id')
            ->orderBy('total_amount', 'DESC')
            ->whereHas('roles', function ($query) {
                $query->where('role_id', 6);
            })->paginate(30);

        $totalOrderMonth = Transaction::where('order_status','active')->where('user_id','!=','')
            ->whereMonth('updated_at',$thang)
            ->whereYear('updated_at',$year)
            ->count();
        $totalAmountMonth = Transaction::where('order_status','active')->where('user_id','!=','')
            ->whereMonth('updated_at',$thang)
            ->whereYear('updated_at',$year)
            ->sum('sub_total');
        $totalPriceMonth = Transaction::where('order_status','active')->where('user_id','!=','')
            ->whereMonth('updated_at',$thang)
            ->whereYear('updated_at',$year)
            ->sum('price');

        return view('wadmin-report::experts',compact(
            'chuyenvien','monthList',
            'commissionRate','thang','totalOrderMonth','totalAmountMonth','totalPriceMonth'
        ));
    }

    public function distributor(Request $request, SettingRepositories $settingRepositories){
        $q = new Company();
        $user_id = $request->get('user_id');
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
        $commissionRate = intval($settingRepositories->getSettingMeta('commission_rate'));
        if(!is_null($user_id)){
            $q->where('company.user_id',$user_id);
        }
        $data = $q->select('company.*')
            ->leftJoin('transaction', function ($join) use($thang,$year){
                $join->on('company.id','=','transaction.company_id')
                    ->where('transaction.order_status','active')
                    ->whereMonth('transaction.updated_at',$thang)
                    ->whereYear('transaction.updated_at',$year);
            })
            ->selectRaw('SUM(transaction.sub_total) as total_amount')
            ->selectRaw('COUNT(transaction.id) as totalOrder')
            ->selectRaw('SUM(transaction.commission) as total_commission')
            ->groupBy('company.id')
            ->orderBy('total_amount', 'DESC')
            ->where('company.status','active')
            ->where('company.c_type','distributor')
            ->paginate(30);

//        dd($data);
        $totalOrderMonth = Transaction::where('order_status','active')
            ->whereMonth('updated_at',$thang)
            ->whereYear('updated_at',$year)
            ->count();
        $totalAmountMonth = Transaction::where('order_status','active')
            ->whereMonth('updated_at',$thang)
            ->whereYear('updated_at',$year)
            ->sum('sub_total');
        $totalCommissionMonth = Transaction::where('order_status','active')
            ->whereMonth('updated_at',$thang)
            ->whereYear('updated_at',$year)
            ->sum('commission');

        $userChuyenvien = Users::whereHas('roles', function ($query) {
            $query->where('role_id', 6);
        })->get();
        return view('wadmin-report::distributor',compact(
            'data','monthList',
            'thang','commissionRate',
            'totalOrderMonth','totalAmountMonth','userChuyenvien','totalCommissionMonth'
        ));
    }

    public function director(Request $request, SettingRepositories $settingRepositories){
        $q = new Users();
        $user = $request->user;
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
        if(!is_null($request->mon)){
            $q->whereMonth('transaction.updated_at',$thang);
            $q->whereYear('transaction.updated_at',$year);
        }
        $data = $q->select('users.*')
            ->leftJoin('transaction', function ($join) use($thang,$year){
                $join->on('users.id','=','transaction.director')
                    ->where('transaction.order_status','active');
            })
            ->selectRaw('SUM(transaction.sub_total) as total_amount')
            ->selectRaw('COUNT(transaction.id) as totalOrder')
            ->selectRaw('SUM(transaction.price) as totalPrice')
            ->groupBy('users.id')
            ->orderBy('total_amount', 'DESC')
            ->whereHas('roles', function ($query) {
                $query->where('role_id', 7);
            })->paginate(30);
//        dd($data);

        $commission = Commission::where('role_id',7)->first();
        $commissionRate = ($commission->commission_rate / 100);

        return view('wadmin-report::director',compact('data','monthList','thang','commissionRate'));
    }

    public function totalDistributor(Request $request){
        $u = $request->u;
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
        $q = Company::query();
        $w = Company::query();
        $v = Company::query();
        $userRequest = null;
        if(!is_null($u)){
            $q->where('user_id',$u);
            $w->where('user_id',$u);
            $v->where('user_id',$u);
            $userRequest = Users::find($u);
        }
        if(!is_null($mon)){
            $q->whereMonth('updated_at',$mon)->whereYear('updated_at',$year);
            $w->whereMonth('updated_at',$mon)->whereYear('updated_at',$year);
            $v->whereMonth('updated_at',$mon)->whereYear('updated_at',$year);
        }
        $totalCompanyActive = $q->where('status','active')->where('c_type','distributor')->count();
        $totalCompanyPending = $w->where('status','pending')->where('c_type','distributor')->count();
        $totalCompany = $v->where(function($e){
            $e->where('c_type','distributor')->where('status','active')->orWhere('status','pending');
        })->count();

//        $users = Users::whereHas('roles', function ($query){
//            $query->where('role_id', 6);
//        })->get();

        $users = Users::select('users.*')
            ->leftJoin('company', function ($join) use($thang,$year){
                $join->on('users.id','=','company.user_id')
                    ->whereMonth('company.updated_at',$thang)
                    ->whereYear('company.updated_at',$year)
                    ->where('company.status','!=','disable');
            })
            ->selectRaw('COUNT(company.id) AS countCompany')
            ->groupBy('users.id')
            ->orderBy('countCompany', 'DESC')
            ->whereHas('roles', function ($query) {
                $query->where('role_id', 6);
            })->get();

        return view('wadmin-report::totaldistributor',compact(
            'monthList',
            'thang',
            'year',
            'totalCompanyActive',
            'totalCompanyPending',
            'totalCompany',
            'users',
            'userRequest'
        ));
    }

    public function totalSaleDistributor(Request $request){
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
        $users = Users::select('users.*')
            ->leftJoin('company', function ($join) use($thang,$year){
                $join->on('users.id','=','company.sale_admin')
                    ->where('company.status','!=','disable');
            })
            ->selectRaw('COUNT(company.id) AS countCompany')
            ->groupBy('users.id')
            ->orderBy('countCompany', 'DESC')
            ->whereHas('roles', function ($query) {
                $query->where('role_id', 9);
            })->get();
        return view('wadmin-report::sales',compact('users','thang','year','monthList'));
    }

}

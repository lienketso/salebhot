<?php

namespace Reports\Http\Controllers;

use Acl\Models\Role;
use Barryvdh\Debugbar\Controllers\BaseController;
use Carbon\Carbon;
use Commission\Models\Commission;
use Company\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                    ->whereMonth('transaction.created_at',$thang)
                    ->whereYear('transaction.created_at',$year);
            })
            ->selectRaw('SUM(transaction.amount) as total_amount')
            ->selectRaw('COUNT(transaction.id) as totalOrder')
            ->groupBy('users.id')
            ->orderBy('total_amount', 'DESC')
            ->whereHas('roles', function ($query) {
                $query->where('role_id', 6);
            })->paginate(30);

        $totalOrderMonth = Transaction::where('order_status','active')
            ->whereMonth('created_at',$thang)
            ->whereYear('created_at',$year)
            ->count();
        $totalAmountMonth = Transaction::where('order_status','active')
            ->whereMonth('created_at',$thang)
            ->whereYear('created_at',$year)
            ->sum('amount');

        return view('wadmin-report::experts',compact(
            'chuyenvien','monthList',
            'commissionRate','thang','totalOrderMonth','totalAmountMonth'
        ));
    }

    public function distributor(Request $request){
        $q = new Company();
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
//        $data = $q->with(['getTransaction'=>function($query) use($thang,$year){
//            $query->where('order_status','active')->whereMonth('created_at',$thang)->whereYear('created_at',$year);
//        }])
//            ->orderBy('name','asc')
//            ->where('status','active')->paginate(30);
        $commissionRate = (40/100);

        $data = Company::select('company.*')
            ->leftJoin('transaction', function ($join) use($thang,$year){
                $join->on('company.id','=','transaction.company_id')
                    ->where('transaction.order_status','active')
                    ->whereMonth('transaction.created_at',$thang)
                    ->whereYear('transaction.created_at',$year);
            })
            ->selectRaw('SUM(transaction.amount) as total_amount')
            ->selectRaw('COUNT(transaction.id) as totalOrder')
            ->groupBy('company.id')
            ->orderBy('total_amount', 'DESC')
            ->where('company.status','active')->paginate(30);

//        dd($data);
        $totalOrderMonth = Transaction::where('order_status','active')
            ->whereMonth('created_at',$thang)
            ->whereYear('created_at',$year)
            ->count();
        $totalAmountMonth = Transaction::where('order_status','active')
            ->whereMonth('created_at',$thang)
            ->whereYear('created_at',$year)
            ->sum('amount');

        return view('wadmin-report::distributor',compact(
            'data','monthList',
            'thang','commissionRate',
            'totalOrderMonth','totalAmountMonth'
        ));
    }

    public function director(Request $request){
        $q = new Users();
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

        $data = $q->whereHas('roles', function ($query) {
            $query->where('role_id', 7);
        })->paginate(20);
        $commission = Commission::where('role_id',7)->first();
        $commissionRate = ($commission->commission_rate / 100);

        return view('wadmin-report::director',compact('data','monthList','thang','commissionRate'));
    }



}

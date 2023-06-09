<?php
namespace Wallets\Http\Controllers;
use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use Wallets\Models\Wallets;
use Wallets\Models\WalletTransaction;
use Wallets\Repositories\WalletRepository;

class WalletController extends BaseController
{
    protected $model;
    public function __construct(WalletRepository $walletRepository)
    {
        $this->model = $walletRepository;
    }

    public function getIndex(Request $request){

        $q = Wallets::query();
        if(!is_null($request->name)){
            $q->whereHas('getDistributor',function ($query) use($request){
                return $query->where('name','LIKE','%'.$request->name.'%');
            });
        }
        if(!is_null($request->company_code)){
            $q->whereHas('getDistributor',function ($query) use($request){
                return $query->where('company_code',$request->company_code);
            });
        }
        $data = $q->orderBy('balance','desc')->paginate(30);
        return view('wadmin-wallets::index',compact('data'));
    }

    public function history(){
        $q = WalletTransaction::query();
        $data = $q->orderBy('created_at','desc')->paginate(30);
        return view('wadmin-wallets::history',compact('data'));
    }

}

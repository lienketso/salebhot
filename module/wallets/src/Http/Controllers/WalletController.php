<?php
namespace Wallets\Http\Controllers;
use App\ExcelWithdraw;
use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Logs\Repositories\LogsRepository;
use Maatwebsite\Excel\Facades\Excel;
use Wallets\Models\Wallets;
use Wallets\Models\WalletTransaction;
use Wallets\Repositories\WalletRepository;
use Wallets\Repositories\WalletTransactionRepository;

class WalletController extends BaseController
{
    protected $model;
    protected $log;
    protected $wa;
    public function __construct(WalletRepository $walletRepository, LogsRepository $logsRepository, WalletTransactionRepository $walletTransactionRepository)
    {
        $this->model = $walletRepository;
        $this->log = $logsRepository;
        $this->wa = $walletTransactionRepository;
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

    //Yêu cầu rút tiền
    public function withdraw(Request $request){
        $q = WalletTransaction::query();
        if(!is_null($request->id)){
            $q->where('id',$request->id);
        }
        $data = $q->orderBy('created_at','desc')
            ->where('status','pending')
            ->where('transaction_type','minus')->paginate(30);
        if(!is_null($request->get('export'))){
            $exports = $q->with('company')->where('status','pending')
                ->orderBy('created_at','desc')->paginate(2000);
            return Excel::download(new ExcelWithdraw($exports), 'danh-sach-chuyen-khoan.xlsx');
        }
        return view('wadmin-wallets::withdraw.index',compact('data'));
    }

    public function withdrawAccept($id){
        try {
            $data = WalletTransaction::where('id',$id)->first();
            $data->status = 'accept';
            $data->user_id = Auth::id();
            //Trừ tiền trong ví
            $wallet = $this->model->find($data->wallet_id);
            $sodu = $wallet->balance - $data->amount;

            if($wallet->balance>=$data->amount){
                $wallet->balance = $sodu;
                $wallet->save();
            }else{
                return redirect()->route('wadmin::wallet.withdraw.get')
                    ->with('delete','Lỗi : số dư ví nhỏ hơn số tiền cần rút !');
            }
            $data->save();
            //log
            $dh = '<a target="_blank" href="'.route('wadmin::wallet.withdraw.get',['id'=>$data->id]).'">#YC'.$data->id.'</a>';
            $logdata = [
                'user_id'=>\Illuminate\Support\Facades\Auth::id(),
                'action'=>'accept',
                'action_id'=>$data->id,
                'module'=>'Wallets',
                'description'=>'Xác nhận yêu cầu rút tiền '.$dh
            ];
            $logs = $this->log->create($logdata);
            return redirect()->route('wadmin::wallet.withdraw.get')
                ->with('create','Duyệt yêu cầu rút tiền thành công ');
        }catch (\Exception $e){
            return redirect()->route('wadmin::wallet.withdraw.get')
                ->with('delete',$e->getMessage());
        }

    }

    public function withdrawDone(){
        $q = WalletTransaction::query();
        $data = $q->orderBy('created_at','desc')
            ->where('status','accept')
            ->where('transaction_type','minus')
            ->paginate(30);
        return view('wadmin-wallets::withdraw.accept',compact('data'));
    }

    public function getRefund($id){
        $q = WalletTransaction::query();
        $data = $q->where('id',$id)->first();
        return view('wadmin-wallets::withdraw.refund',compact('data'));
    }
    public function postRefund(Request $request,$id){
        $request->validate([
            'description' => 'required|min:5',
        ]);
        try {
            $q = WalletTransaction::query();
            $data = $q->where('id',$id)->first();
            $data->description = $request->description;
            $data->status = $request->status;
            $data->save();
            //tạo thêm đơn hoàn tiền
            $new =[
                'user_id'=>Auth::id(),
                'company_id'=>$data->company_id,
                'wallet_id'=>$data->wallet_id,
                'transaction_type'=>'refund',
                'status'=>'refunded',
                'amount'=>$data->amount,
                'description'=>$data->description
            ];
            $create = $this->wa->create($new);
            //hoàn tiền + vào ví
            $wallet = $this->model->find($data->wallet_id);
            $fund = $wallet->balance + $data->amount;
            $wallet->balance = $fund;
            $wallet->save();
            //Log
            $dh = '<a target="_blank" href="'.route('wadmin::wallet.list-refund.get',['id'=>$data->id]).'">#REFUND'.$data->id.'</a>';
            $logdata = [
                'user_id'=>\Illuminate\Support\Facades\Auth::id(),
                'action'=>'refund',
                'action_id'=>$data->id,
                'module'=>'Wallets',
                'description'=>'Đã hoàn tiền +'.number_format($data->amount).' vào ví cho đại lý '.$dh
            ];
            $logs = $this->log->create($logdata);
            return redirect()->route('wadmin::wallet.accept.get')
                ->with('create','Hoàn tiền thành công !');
        }catch (\Exception $e){
            return redirect()->back()
                ->with('delete',$e->getMessage());
        }

    }

    public function refundList(Request $request){

        $q = WalletTransaction::query();
        if(!is_null($request->get('id'))){
            $q->where('id',$request->get('id'));
        }
        $data = $q->where('status','refunded')
            ->where('transaction_type','refund')
            ->paginate(30);
        return view('wadmin-wallets::withdraw.refund-list',compact('data'));
    }

}

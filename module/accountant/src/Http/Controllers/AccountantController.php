<?php
namespace Accountant\Http\Controllers;
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

class AccountantController extends BaseController
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

    public function requestAdmin($id,WalletTransactionRepository $walletTransactionRepository){
        try {
            $data = Wallets::where('id',$id)->first();
            $data->send_admin = 'sent';
            $data->save();
            //create transaction wallet
            $trans = [
              'user_id'=>Auth::id(),
              'company_id'=>$data->company_id,
              'wallet_id'=>$data->id,
              'transaction_type'=>'minus',
              'amount'=>$data->balance,
              'description'=>'Gửi yêu cầu chuyển tiền cho đại lý đến admin'
            ];
            $transactionWallet = $walletTransactionRepository->create($trans);
            //log
            $logdata = [
                'user_id'=>\Illuminate\Support\Facades\Auth::id(),
                'action'=>'accept',
                'action_id'=>$data->id,
                'module'=>'Wallets',
                'description'=>'Xác nhận yêu cầu rút tiền đại lý '.$data->getDistributor->name
            ];
            $logs = $this->log->create($logdata);
            return redirect()->route('wadmin::accountant-check.get')
                ->with('create','Gửi yêu cầu đến admin thành công cho đại lý: '.$data->getDistributor->name);
        }catch (\Exception $e){
            return redirect()->route('wadmin::accountant-check.get')
                ->with('delete',$e->getMessage());
        }

    }
    // gửi nhiều nhà phân phối
    public function requestAll(Request $request){
        $ids = $request->ids;
        $status = $request->status;
        try {
            $data = Wallets::whereIn('id',explode(",",$ids))->get();
            foreach($data as $d){
                $d->send_admin = 'sent';
                $d->save();
                //tạo giao dịch
                $trans = [
                    'user_id'=>Auth::id(),
                    'company_id'=>$d->company_id,
                    'wallet_id'=>$d->id,
                    'transaction_type'=>'minus',
                    'amount'=>$d->balance,
                    'description'=>'Gửi yêu cầu chuyển tiền cho đại lý đến admin'
                ];
                $transactionWallet = $this->wa->create($trans);
            }
            return redirect()->back()->with('create','Gửi nhiều yêu cầu thành công !');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function accountantCheck(Request $request){
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
        $data = $q->where('balance','>',0)->orderBy('balance','desc')->paginate(50);
        if(!is_null($request->get('export'))){
            $exports = $q->with('getDistributor')->where('balance','>',0)
                ->orderBy('balance','desc')->paginate(6000);
            return Excel::download(new ExcelWithdraw($exports), 'danh-sach-chuyen-khoan.xlsx');
        }
        return view('wadmin-accountant::accountant',compact('data'));
    }

    public function getConfirmBank(){
        $q = WalletTransaction::query();
        $data = $q->where('status','confirm')->orderBy('updated_at','desc')->paginate(50);
        return view('wadmin-accountant::confirm',compact('data'));
    }

    public function postConfirmBank($id){
        try {
            $data = $this->wa->find($id);
            $data->status = 'transferred';
            $data->save();
            //Trừ tiền trong ví
            $walletInfor = $this->model->find($data->wallet_id);
            $oldBalance = $walletInfor->balance;
            $walletInfor->balance = $oldBalance - $data->amount;
            $walletInfor->send_admin = 'unsent';
            $walletInfor->save();
            return redirect()->back()->with('create','Xác nhận thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    //xác nhận đã chuyển tiền nhanh
    public function postTransferredAll(Request $request){
        $ids = $request->ids;
        $status = $request->status;
        try {
            $data = WalletTransaction::whereIn('id',explode(",",$ids))->get();
            foreach($data as $d){
                $d->status = 'transferred';
                $d->save();
                $walletInfor = $this->model->find($d->wallet_id);
                $oldBalance = $walletInfor->balance;
                $walletInfor->balance = $oldBalance - $d->amount;
                $walletInfor->send_admin = 'unsent';
                $walletInfor->save();
            }
            return response()->json($data);
        }catch (\Exception $e){
            return response()->json($e->getMessage());
        }
    }

    //danh sách đã hoàn thành chuyển tiền
    public function getTransferred(){
        $q = WalletTransaction::query();
        $data = $q->where('status','transferred')->orderBy('updated_at','desc')->paginate(50);
        return view('wadmin-accountant::transferred',compact('data'));
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

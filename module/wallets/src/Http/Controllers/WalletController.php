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
        if(!is_null($request->company_code)){
            $code = $request->company_code;
            $q->whereHas('company',function ($e) use ($code){
                return $e->where('company_code',$code)->orWhere('name',$code)->orWhere('phone',$code);
            });
        }
        if(!is_null($request->updated_at)){
            $updated_at = $request->updated_at;
            $q->whereDate('updated_at',$updated_at);
        }
        $data = $q->orderBy('created_at','desc')
            ->where('status','pending')
            ->where('transaction_type','minus')->paginate(30);
        if(!is_null($request->get('export'))){
            $exports = $q->with('company')->where('status','pending')
                ->where('transaction_type','minus')
                ->orderBy('created_at','desc')->paginate(5000);
            return Excel::download(new ExcelWithdraw($exports), 'danh-sach-chuyen-khoan.xlsx');
        }
        return view('wadmin-wallets::withdraw.index',compact('data'));
    }


    public function bankConfirm($id){
        try{
            $data = WalletTransaction::find($id);
            $data->status = 'confirm';
            $data->admin_id = Auth::id();
            $data->save();
            return redirect()->back()->with('create','Duyệt yêu cầu thành công !');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    //Duyệt nhiều nhà phân phối
    public function bankConfirmAll(Request $request){
        $ids = $request->ids;
        $status = $request->status;
        try {
            $data = WalletTransaction::whereIn('id',explode(",",$ids))->get();
            foreach($data as $d){
                $d->status = 'confirm';
                $d->admin_id = Auth::id();
                $d->save();
            }
            return response()->json($data);
        }catch (\Exception $e){
            return response()->json($e->getMessage());
        }
    }

    public function withdrawDone(){
        $q = WalletTransaction::query();
        $data = $q->orderBy('created_at','desc')
            ->where('status','!=','pending')
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

    //Admin xác nhận kế toán đã chuyển khoản lần 2
    public function successBank(Request $request){
        $q = WalletTransaction::query();
        if(!is_null($request->company_code)){
            $code = $request->company_code;
            $q->whereHas('company',function ($e) use ($code){
                return $e->where('company_code',$code)->orWhere('name',$code)->orWhere('phone',$code);
            });
        }
        if(!is_null($request->updated_at)){
            $updated_at = $request->updated_at;
            $q->whereDate('updated_at',$updated_at);
        }
        $data = $q->where('status','transferred')
            ->orderBy('updated_at','desc')
            ->paginate(50);
        return view('wadmin-wallets::withdraw.success',compact('data'));
    }
    public function postSuccessBank($id){
        try {
            $data = WalletTransaction::find($id);
            $data->status = 'completed';
            $data->save();
            //Trừ tiền trong ví
            $walletInfor = $this->model->find($data->wallet_id);
            $oldBalance = $walletInfor->balance;
            $walletInfor->balance = $oldBalance - $data->amount;
            $walletInfor->send_admin = 'unsent';
            $walletInfor->save();
            return redirect()->back()->with('create','Xác nhận thành công chuyển tiền thành công cho đại lý');
        }catch (\Exception $e){
            return redirect()->back()->with('delete',$e->getMessage());
        }

    }
    //Xác nhận nhanh
    public function successAll(Request $request){
        $ids = $request->ids;
        $status = $request->status;
        try {
            $data = WalletTransaction::whereIn('id',explode(",",$ids))->get();
            foreach($data as $d){
                $d->status = 'completed';
                $d->save();
                //Trừ tiền trong ví
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
    //Danh sách chuyển tiền thành công
    public function listCompleted(Request $request){
        $q = WalletTransaction::query();
        if(!is_null($request->company_code)){
            $code = $request->company_code;
            $q->whereHas('company',function ($e) use ($code){
               return $e->where('company_code',$code)->orWhere('name',$code)->orWhere('phone',$code);
            });
        }
        if(!is_null($request->updated_at)){
            $updated_at = $request->updated_at;
            $q->whereDate('updated_at',$updated_at);
        }
        $data = $q->where('status','completed')
            ->orderBy('updated_at','desc')
            ->paginate(50);
        return view('wadmin-wallets::withdraw.completed',compact('data'));
    }


}

<?php


namespace Transaction\Http\Controllers;


use Auth\Supports\Traits\Auth;
use Barryvdh\Debugbar\Controllers\BaseController;
use Company\Models\Company;
use Illuminate\Http\Request;
use Logs\Repositories\LogsRepository;
use Order\Models\OrderProduct;
use PHPUnit\Exception;
use Product\Models\Factory;
use Product\Models\Product;
use Telegram\Bot\Laravel\Facades\Telegram;
use Transaction\Http\Requests\TransactionCreateRequest;
use Transaction\Http\Requests\TransactionEditRequest;
use Transaction\Models\Transaction;
use Transaction\Repositories\TransactionRepository;
use Wallets\Repositories\WalletRepository;
use Wallets\Repositories\WalletTransactionRepository;

class TransactionController extends BaseController
{
    protected $model;
    protected $wallet;
    protected $wallettrans;
    protected $log;
    public function __construct(TransactionRepository $transactiontRepository, WalletRepository $walletRepository,
                                WalletTransactionRepository $walletTransactionRepository,LogsRepository $logsRepository)
    {
        $this->model = $transactiontRepository;
        $this->wallet = $walletRepository;
        $this->wallettrans = $walletTransactionRepository;
        $this->log = $logsRepository;
    }

    public function getIndex(Request $request){
        $id = $request->get('id');
        $name = $request->get('name');
        $company_code = $request->get('company_code');
        $status = $request->get('status');
        $q = Transaction::query();
        if(!is_null($id)){
            $q->where('id',$id);
        }
        if(!is_null($name)){
            $q->where('name','LIKE','%'.$name.'%')->orWhere('phone',$name);
        }
        if(!is_null($company_code)){
            $q->where('company_code',$company_code);
        }
        if(!is_null($status)){
            $q->where('order_status',$status);
        }
        $data = $q->where('order_status','!=','removed')
            ->orderBy('created_at','desc')->paginate(20);

        $countActive = Transaction::where('order_status','active')->count();
        $countPayment = Transaction::where('order_status','payment')->count();
        $countPending = Transaction::where('order_status','disable')->count();
        $countCancel = Transaction::where('order_status','cancel')->count();
        $countAll = Transaction::count();

        return view('wadmin-transaction::index',compact('data','countActive','countPayment','countPending','countCancel','countAll'));
    }

    public function getCreate(){
        $products = Product::orderBy('created_at','desc')->where('status','active')->get();
        $hangsx = Factory::orderBy('sort_order','asc')->where('status','active')->get();
        $company = Company::orderBy('name','asc')->where('status','active')->get();
        return view('wadmin-transaction::create',compact('products','hangsx','company'));
    }

    public function postCreate(TransactionCreateRequest $request){
        try {
            $input = $request->except(['_token', 'continue_post']);
            $products = json_encode($request->products);
            $input['products'] = $products;
            if(!is_null($request->company_id)){
                $companyInfo = Company::find($request->company_id);
                $input['company_code'] = $companyInfo->company_code;
                $input['user_id'] = $companyInfo->user_id;
            }

            $data = $this->model->create($input);
            $totallamount = 0;
            if(!is_null($request->products)){
                foreach($request->products as $p){
                    $productInfo = Product::find($p);
                    $totallamount = $totallamount + $productInfo->price;
                    $pro = [
                        'product_id'=>$p,
                        'transaction_id'=>$data->id,
                        'qty'=>1,
                        'amount'=>$productInfo->price
                    ];
                    $order = OrderProduct::create($pro);
                }
            }
            $amountUp = ['amount'=>$totallamount];
            $updateAmount = $this->model->update($amountUp,$data->id);
            if($request->has('continue_post')){
                return redirect()
                    ->route('wadmin::transaction.create.get')
                    ->with('create','Thêm dữ liệu thành công !');
            }
            return redirect()->route('wadmin::transaction.index.get')
                ->with('create','Thêm dữ liệu thành công !');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getEdit($id){
        $products = Product::orderBy('created_at','desc')->where('status','active')->get();
        $hangsx = Factory::orderBy('sort_order','asc')->where('status','active')->get();
        $company = Company::orderBy('name','asc')->where('status','active')->get();
        $data = $this->model->find($id);
        if(!$data){
            redirect()->back()->withErrors(config('messages.error'));
        }
        $currentProduct = [];
        $productChecked = $data->orderProduct()->get()->toArray();
        foreach($productChecked as $check){
            $currentProduct[] = $check['product_id'];
        }
        return view('wadmin-transaction::edit',compact('data','products','hangsx','company','currentProduct'));
    }

    public function postEdit($id,TransactionEditRequest $request){
        $input = $request->except(['_token', 'continue_post']);
        $data = $this->model->find($id);
        try {
            if(!is_null($request->company_id)){
                $companyInfo = Company::find($request->company_id);
                $input['company_code'] = $companyInfo->company_code;
            }
            $update = $this->model->update($input,$id);
            $totallamount = 0;
            if(!is_null($request->products)){
                foreach($request->products as $p){
                    $productInfo = Product::find($p);
                    $totallamount = $totallamount + $productInfo->price;
                    $order = OrderProduct::updateOrCreate(['transaction_id'=>$id],['product_id'=>$p,'amount'=>$productInfo->amount]);
                }
            }
            //cộng tiền vào ví
            if($data->order_status!='active') {
                if ($update->order_status == 'active') {
                    $nppWallet = $this->wallet->findWhere(['company_id' => $update->company_id])->first();
                    $nppWallet->balance = $nppWallet->balance + ($update->amount * 0.4);
                    $nppWallet->save();
                    $d = [
                        'company_id' => $update->company_id,
                        'wallet_id' => $nppWallet->id,
                        'transaction_type' => 'plus',
                        'transaction_id' => $update->id,
                        'amount' => ($update->amount * 0.4)
                    ];
                    $createWalletTran = $this->wallettrans->create($d);
                }
            }
            //logs
            $dh = '<a target="_blank" href="'.route('wadmin::transaction.index.get',['id'=>$data->id]).'">#DH'.$data->id.'</a>';
            $logdata = [
                'user_id'=>\Illuminate\Support\Facades\Auth::id(),
                'action'=>'update',
                'action_id'=>$data->id,
                'module'=>'Transaction',
                'description'=>'Sửa thông tin đơn hàng '.$dh
            ];
            $logs = $this->log->create($logdata);
            return redirect()->route('wadmin::transaction.index.get')
                ->with('create','Sửa dữ liệu thành công !');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }

    }


    function remove($id){
        try{
            $data = $this->model->find($id);
//            $this->model->delete($id);
            $data->order_status = 'removed';
            $data->save();
            //logs
            $dh = '<a target="_blank" href="'.route('wadmin::transaction.removed.get',['id'=>$data->id]).'">#DH'.$data->id.'</a>';
            $logdata = [
                'user_id'=>\Illuminate\Support\Facades\Auth::id(),
                'action'=>'delete',
                'action_id'=>$data->id,
                'module'=>'Transaction',
                'description'=>'Xóa đơn hàng '.$dh
            ];
            $logs = $this->log->create($logdata);
            return redirect()->back()->with('delete','Bạn vừa xóa dữ liệu !');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    public function removed(Request $request){
        $query = Transaction::query();
        if(!is_null($request->get('id'))){
            $query->where('id',$request->get('id'));
        }
        $data = $query->orderBy('created_at','desc')
            ->where('order_status','removed')
            ->paginate(30);
        return view('wadmin-transaction::removed',compact('data'));
    }

    public function changeStatus($id){
        $input = [];
        $data = $this->model->find($id);
        if($data->status=='active'){
            $input['status'] = 'disable';
        }elseif ($data->status=='disable'){
            $input['status'] = 'active';
        }
        $this->model->update($input,$id);
        return redirect()->back();
    }

    public function accept(){
        $saleLogin = \Illuminate\Support\Facades\Auth::user();
        $q = Transaction::query();
        $data = $q->where('sale_admin',$saleLogin->id)
            ->where('order_status','!=','active')
            ->paginate(30);
        return view('wadmin-transaction::accept',compact('data'));
    }

    public function changeAll(Request $request){
        $ids = $request->ids;
        $status = $request->status;
        $data = Transaction::whereIn('id',explode(",",$ids))->get();
        foreach($data as $d){
            if($d->order_status!='active' && $status == 'active') {
                $nppWallet = $this->wallet->findWhere(['company_id' => $d->company_id])->first();
                $nppWallet->balance = $nppWallet->balance + ($d->amount * 0.4);
                $nppWallet->save();
                $don = [
                    'company_id' => $d->company_id,
                    'wallet_id' => $nppWallet->id,
                    'transaction_type' => 'plus',
                    'transaction_id' => $d->id,
                    'amount' => ($d->amount * 0.4)
                ];
                $createWalletTran = $this->wallettrans->create($don);
            }
            $d->order_status = $status;
            $d->save();
        }
        //logs
        $logdata = [
            'user_id'=>\Illuminate\Support\Facades\Auth::id(),
            'action'=>'update',
            'module'=>'Transaction',
            'description'=>'Cập nhật trạng thái nhiều đơn hàng '.$ids
        ];
        $logs = $this->log->create($logdata);
        return response()->json($data);
    }

    public function price($id){
        $data = $this->model->find($id);
        return view('wadmin-transaction::price',compact('data'));
    }
    public function postPrice(Request $request, $id){
        try {
            $data = $this->model->find($id);
            $data->amount = $request->amount;
            $data->save();
            //logs
            $dh = '<a target="_blank" href="'.route('wadmin::transaction.index.get',['id'=>$data->id]).'">#DH'.$data->id.'</a>';
            $logdata = [
              'user_id'=>\Illuminate\Support\Facades\Auth::id(),
              'action'=>'update',
              'action_id'=>$data->id,
              'module'=>'Transaction',
              'description'=>'Sửa số tiền cho đơn hàng '.$dh
            ];
            $logs = $this->log->create($logdata);
            return redirect()->route('wadmin::transaction.index.get',['page'=>$request->page])->with('edit','Sửa giá trị thành công');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }

    }

    public function updatedActivity()
    {
        $activity = Telegram::getUpdates();
        dd($activity);
        $text = "A new contact us query\n"
            . "<b>Email Address: </b>\n"
            . "thanhan1507@gmail.com\n"
            . "<b>Message: </b>\n"
            . "tester";

        Telegram::sendMessage([
            'chat_id' => 5449285604,
            'parse_mode' => 'HTML',
            'text' => $text
        ]);
    }

}

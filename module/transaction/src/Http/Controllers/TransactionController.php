<?php


namespace Transaction\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Company\Models\Company;
use Discounts\Models\Discounts;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Logs\Repositories\LogsRepository;
use Order\Models\OrderProduct;
use PHPUnit\Exception;
use Product\Models\Factory;
use Product\Models\Product;
use Setting\Repositories\SettingRepositories;
use Telegram\Bot\Laravel\Facades\Telegram;
use Transaction\Http\Requests\TransactionCreateRequest;
use Transaction\Http\Requests\TransactionEditRequest;
use Transaction\Models\Transaction;
use Transaction\Models\TransactionStatus;
use Transaction\Repositories\TransactionRepository;
use Users\Models\Users;
use Wallets\Models\Wallets;
use Wallets\Repositories\WalletRepository;
use Wallets\Repositories\WalletTransactionRepository;

class TransactionController extends BaseController
{
    protected $model;
    protected $wallet;
    protected $wallettrans;
    protected $log;
    protected $setting;
    public function __construct(TransactionRepository $transactiontRepository, WalletRepository $walletRepository,
                                WalletTransactionRepository $walletTransactionRepository,LogsRepository $logsRepository, SettingRepositories $settingRepositories)
    {
        $this->model = $transactiontRepository;
        $this->wallet = $walletRepository;
        $this->wallettrans = $walletTransactionRepository;
        $this->log = $logsRepository;
        $this->setting = $settingRepositories;
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
        $data = $q->orderBy('created_at','desc')->paginate(20);

        $countActive = Transaction::where('order_status','active')->count();
        $countReceived = Transaction::where('order_status','received')->count();
        $countPending = Transaction::where('order_status','disable')->count();
        $countCancel = Transaction::where('order_status','cancel')->count();
        $countAll = Transaction::count();

        return view('wadmin-transaction::index',compact('data','countActive','countReceived','countPending','countCancel','countAll'));
    }

    public function getCreate(){
        $products = Product::orderBy('created_at','desc')->where('status','active')->get();
        $hangsx = Factory::orderBy('sort_order','asc')->where('status','active')->get();
        $company = Company::orderBy('name','asc')->where('status','active')->where('c_type','distributor')->get();
        //chiết khấu
        $discounts = Discounts::where('status','active')->orderBy('sort_order','asc')->get();
        return view('wadmin-transaction::create',compact('products','hangsx','company','discounts'));
    }

    public function postCreate(TransactionCreateRequest $request){
        $distributor_rate = intval($this->setting->getSettingMeta('commission_rate'));
        try {
            $input = $request->except(['_token', 'continue_post']);

            $products = json_encode($request->products);
            $input['products'] = $products;
            $sale_admin = '@salebaohiemoto01';
            $amount = str_replace(',','',$request->amount);
            $amount = intval($amount);

            $vatMoney = $amount * 0.1;
            $tienSauthue = $amount - $vatMoney;

            $commission = $tienSauthue * ($distributor_rate/100);

            $companyInfo = Company::find($request->company_id);
            $userInfo = Users::find($companyInfo->user_id);
            $saleInfo = Users::find($userInfo->sale_admin);
            $sale_admin = $saleInfo->telegram;
            $input['company_code'] = $companyInfo->company_code;
            $input['user_id'] = $companyInfo->user_id;
            $input['sale_admin'] = $userInfo->sale_admin;
            $input['director'] = $userInfo->parent;

            if(!is_null($request->discount_show) && $request->discount_show==1){
                $discount = Discounts::find($request->discount_id);
                $discountAmount = $tienSauthue * ($discount->value/100);
                $input['discount_amount'] = $discountAmount;
                $input['sub_total'] = $amount - $discountAmount;
                if($discount->value>=$distributor_rate){
                    $commission = 0;
                }else{
                    $commission = $commission-$discountAmount;
                }
            }
            $input['commission'] = $commission;
            //thêm mới đơn hàng
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
            //Cộng tiền vào ví nếu status active
            if($request->order_status=='active'){
                $nppWallet = $this->wallet->findWhere(['company_id' => $data->company_id])->first();
                $nppWallet->balance = $nppWallet->balance + $commission;
                $nppWallet->save();
                $d = [
                    'company_id' => $data->company_id,
                    'wallet_id' => $nppWallet->id,
                    'transaction_type' => 'plus',
                    'transaction_id' => $data->id,
                    'amount' => $commission,
                    'description'=>'Cộng tiền hoa hồng vào ví NPP'
                ];
                $createWalletTran = $this->wallettrans->create($d);
            }
            //trạng thái đơn hàng
            $transaction_status = TransactionStatus::updateOrCreate(['status'=>$request->order_status,'transaction_id'=>$data->id],
                [
                    'transaction_id'=>$data->id,
                    'user_id'=>Auth::id(),
                    'status'=>$request->order_status,
                    'description'=>'Cập nhật trạng thái đơn hàng: '.$request->order_status
                ]);
            //tạo tài khoản guest khi chưa tồn tại
            $company = Company::firstOrCreate(['phone'=>$data->phone],
                ['name'=>'Guest',
                    'contact_name'=>$data->name,
                    'parent'=>$data->company_id,
                    'c_type'=>'guest',
                    'status'=>'pending',
                    'password'=>Hash::make('baohiemoto.vn')
                ]);
            //gửi nhóm telegram

            $telegrame_bot_api = $this->setting->getSettingMeta('bot_api_telegram');
            $apiToken = $telegrame_bot_api;
            $chat_id = $sale_admin;
            $text = "";
            $text .= "Đơn hàng mới từ đại lý <b>" . $companyInfo->name . " - Mã:" . $companyInfo->company_code . "</b>\n";
            $text .= "Địa chỉ <b>" . $companyInfo->address . "</b>\n";
            $text .= "Khách hàng: <b>" . $data->name . "</b>\n";
            $text .= "Số điện thoại: <b>" . $data->phone . "</b>\n";
            $text .= "Sản phẩm: \n";
            foreach ($data->orderProduct as $p) {
                $text .= "" . $p->product->name . "\n";
            }
            $text .= "Ngày hết hạn: <b>" . format_date($data->expiry) . "</b>\n";
            $text .= "Biển số xe: <b>" . $data->license_plate . "</b>\n";
            $text .= "Chuyên viên: <b>" . $userInfo->full_name . "</b>\n";
            $text .= "<a target='_blank' href='" . \route('wadmin::transaction.edit.get', $data->id) . "'>Xem đơn hàng </a>";

            $tele = [
                'chat_id' => $chat_id,
                'parse_mode' => 'HTML',
                'text' => $text
            ];
            $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($tele));

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
        $vat = $data->amount*0.1;
        $sauVat = $data->amount-$vat;

        //chiết khấu
        $discounts = Discounts::where('status','active')->orderBy('sort_order','asc')->get();

        return view('wadmin-transaction::edit',compact('data','products','hangsx','company','currentProduct','discounts','sauVat'));
    }

    public function postEdit($id,TransactionEditRequest $request){
        $input = $request->except(['_token', 'continue_post']);

        $data = $this->model->find($id);
        $amount = str_replace(',','',$request->amount);
        $amount = intval($amount);
        $distributor_rate = intval($this->setting->getSettingMeta('commission_rate'));
        $vatMoney = $amount * 0.1;
        $tienSauthue = $amount - $vatMoney;
        $commission = $tienSauthue * ($distributor_rate/100);

        if(!is_null($request->discount_show) && $request->discount_show==1){
            $discountPecent = intval($request->discount);
            $discountAmount = intval($request->discount_amount);
            if($discountPecent>=$distributor_rate){
                $commission = 0;
            }else{
                $commission = $commission - $discountAmount;
            }
        }

        try {
            if(!is_null($request->company_id)){
                $companyInfo = Company::find($request->company_id);
                $input['company_code'] = $companyInfo->company_code;
                $input['commission'] = $commission;
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
                    $nppWallet->balance = $nppWallet->balance + $commission;
                    $nppWallet->save();
                    $d = [
                        'company_id' => $update->company_id,
                        'wallet_id' => $nppWallet->id,
                        'transaction_type' => 'plus',
                        'transaction_id' => $update->id,
                        'amount' => $commission,
                        'description'=>'Cộng tiền hoa hồng vào ví NPP'
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
            //Thêm trạng thái cập nhật đơn hàng
            $transaction_status = TransactionStatus::updateOrCreate(['status'=>$request->order_status,'transaction_id'=>$id],
                [
                    'transaction_id'=>$id,
                    'user_id'=>Auth::id(),
                    'status'=>$request->order_status,
                    'description'=>'Cập nhật trạng thái đơn hàng: '.$request->order_status
                ]);
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
            ->where('order_status','!=','cancel')
            ->where('order_status','!=','refunded')
            ->paginate(30);
        return view('wadmin-transaction::accept',compact('data'));
    }

    public function changeAll(Request $request){
        $ids = $request->ids;
        $status = $request->status;
        $data = Transaction::whereIn('id',explode(",",$ids))->get();
        $distributor_rate = intval($this->setting->getSettingMeta('commission_rate'));
        $rate = $distributor_rate/100;
        foreach($data as $d){
            if($d->order_status!='active') {
                $vat = $d->amount * 0.1;
                $sauVat = $d->amount - $vat;
                $nppWallet = $this->wallet->findWhere(['company_id' => $d->company_id])->first();
                $nppWallet->balance = $nppWallet->balance + ($sauVat * $rate);
                $nppWallet->save();
                $don = [
                    'company_id' => $d->company_id,
                    'wallet_id' => $nppWallet->id,
                    'transaction_type' => 'plus',
                    'transaction_id' => $d->id,
                    'amount' => ($sauVat * $rate)
                ];
                // cập nhật giao dịch
                $createWalletTran = $this->wallettrans->create($don);
                //lưu trạng thái nếu status != active
                $d->order_status = $status;
                $d->save();
            }

            //Trạng thái đơn hàng
            $transaction_status = TransactionStatus::updateOrCreate(['status'=>$status,'transaction_id'=>$d->id],
                [
                    'transaction_id'=>$d->id,
                    'user_id'=>Auth::id(),
                    'status'=>$status,
                    'description'=>'Cập nhật trạng thái đơn hàng: '.$status
                ]);
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
            $distributor_rate = intval($this->setting->getSettingMeta('commission_rate'));
            $vatMoney = $data->amount * 0.1;
            $tienSauthue = $data->amount- $vatMoney;
            $commission = $tienSauthue * ($distributor_rate/100);
            $data->amount = $request->amount;
            $data->commission = $commission;
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

    public function detail($id){
        $data = $this->model->find($id);
        return view('wadmin-transaction::detail',compact('data'));
    }

    public function expiry(){
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();
        $data = Transaction::where('sale_admin',Auth::id())->whereBetween('expiry', [$startDate, $endDate])
            ->paginate(30);
        return view('wadmin-transaction::expiry',compact('data'));
    }

    public function orderSuccess(Request $request){
        $name = $request->get('name');
        $company_code = $request->get('company_code');

        $q = Transaction::query();

        if(!is_null($name)){
            $q->where('name','LIKE','%'.$name.'%')->orWhere('phone',$name);
        }
        if(!is_null($company_code)){
            $q->where('company_code',$company_code);
        }

        $data = $q->where('order_status','active')
            ->orderBy('updated_at','desc')->paginate(20);
        return view('wadmin-transaction::success',compact('data'));
    }

    public function refundOrder($id){
        $data = $this->model->find($id);
        $vat = $data->amount*0.1;
        $amount = ($data->amount-$vat) * ($data->distributor_rate/100);
        try {
            $data->order_status = 'refunded';
            $data->save();
            //Trừ tiền trong ví khách hàng
            $wallet = Wallets::where('company_id',$data->company_id)->first();
            $money = $wallet->balance - $amount;
            $wallet->balance = $money;
            $wallet->save();
            //Tạo giao dịch transaction_wallet
            $dh = [
              'user_id'=>Auth::id(),
              'company_id'=>$data->company_id,
              'wallet_id'=>$wallet->id,
              'transaction_type'=>'minus',
              'amount'=>$amount,
              'transaction_id'=>$data->id,
              'description'=>'Trừ tiền từ ví hoa hồng cho đơn hàng hoàn',
              'status'=>'refunded'
            ];
            $walletTransaction = $this->wallettrans->create($dh);
            //Thêm trạng thái cập nhật đơn hàng
            $transaction_status = TransactionStatus::updateOrCreate(['status'=>'refunded','transaction_id'=>$id],
                [
                    'transaction_id'=>$id,
                    'user_id'=>Auth::id(),
                    'status'=>'refunded',
                    'description'=>'Cập nhật trạng thái đơn hàng ( Hoàn đơn hàng )'
                ]);
            //logs
            $dh = '<a target="_blank" href="'.route('wadmin::transaction.index.get',['id'=>$data->id]).'">#DH'.$data->id.'</a>';
            $logdata = [
                'user_id'=>\Illuminate\Support\Facades\Auth::id(),
                'action'=>'refund',
                'action_id'=>$data->id,
                'module'=>'Transaction',
                'description'=>'Trừ -'.number_format($amount).' tiền hoa hồng từ ví cho đơn hàng hoàn '.$dh
            ];
            $logs = $this->log->create($logdata);
            return redirect()->back()->with('create','Đơn hàng hoàn thành công, đơn hàng không được tính doanh thu, hoa hồng !');
        }catch (\Exception $e){
            return redirect()->back()->with('delete',$e->getMessage());
        }
    }

    public function orderRefunded(Request $request){
        $name = $request->get('name');
        $company_code = $request->get('company_code');

        $q = Transaction::query();

        if(!is_null($name)){
            $q->where('name','LIKE','%'.$name.'%')->orWhere('phone',$name);
        }
        if(!is_null($company_code)){
            $q->where('company_code',$company_code);
        }

        $data = $q->where('order_status','refunded')
            ->orderBy('updated_at','desc')->paginate(20);
        return view('wadmin-transaction::refunded',compact('data'));
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

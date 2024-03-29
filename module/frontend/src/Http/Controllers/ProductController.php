<?php


namespace Frontend\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Company\Models\Company;
use Company\Repositories\CompanyRepository;
use Discounts\Models\Discounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Media\Models\Media;
use Order\Models\OrderProduct;
use Product\Models\Catproduct;
use Product\Models\Factory;
use Product\Models\Product;
use Product\Models\Seats;
use Product\Repositories\CatproductRepository;
use Product\Repositories\ProductRepository;
use Setting\Repositories\SettingRepositories;
use Transaction\Repositories\TransactionRepository;
use Users\Models\Users;

class ProductController extends BaseController
{
    protected $model;
    protected $lang;
    protected $cat;
    protected $com;
    protected $setting;
    protected $tran;
    public function __construct(ProductRepository $productRepository,
                                CatproductRepository $catproductRepository,
                                CompanyRepository $companyRepository,
                                SettingRepositories $settingRepositories, TransactionRepository $transactionRepository)
    {
        $this->model = $productRepository;
        $this->lang = session('lang');
        $this->cat = $catproductRepository;
        $this->com = $companyRepository;
        $this->setting = $settingRepositories;
        $this->tran = $transactionRepository;
    }

    public function index(Request $request){

        $q = Product::query();

        $data = $q->where('status','active')
            ->where('lang_code',$this->lang)
            ->paginate(20);

        //end cấu hình thẻ meta

        return view('frontend::customer.products.index',[
            'data'=>$data
        ]);
    }

    public function checkout($id){
        $data = $this->model->find($id);
        $category = $this->cat->orderBy('sort_order','asc')->findWhere(['status'=>'active','lang_code'=>$this->lang])->all();
        $listFactory = Factory::orderBy('sort_order','asc')->where('status','active')->get();
        $discountList = Discounts::where('status','active')->orderBy('sort_order','asc')->get();
        $vat = $data->price*0.1;
        $sauVat = $data->price-$vat;
        $seats = Seats::orderBy('sort_order','asc')->get();
       return view('frontend::customer.products.checkout',compact('data','category','listFactory','discountList','sauVat','seats'));
    }

    public function postCheckout($id,Request $request){
        $input = $request->except(['_token']);
        $distributor_rate = intval($this->setting->getSettingMeta('commission_rate'));
        $telegrame_bot_api = $this->setting->getSettingMeta('bot_api_telegram');

        $company_id = Auth::guard('customer')->id();
        $compnayInfo = $this->com->find($company_id);
        $userNPP = Users::where('id', $compnayInfo->user_id)->first();
        $sale = Users::where('id', $compnayInfo->sale_admin)->first();
        if($sale->is_leader==0){
            $leaderInfor = Users::find($sale->sale_leader);
            if(!is_null($leaderInfor)){
                $chanelTelegram = $leaderInfor->telegram;
            }else{
                $chanelTelegram = '@salebaohiemoto01';
            }
        }else{
            if (!is_null($sale)) {
                $chanelTelegram = $sale->telegram;
            }else{
                $chanelTelegram = '@salebaohiemoto01';
            }
        }
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
        ]);
        $amount = str_replace(',','',$request->price);
        $amount = intval($amount);

        $commission = $amount * ($distributor_rate/100);

        $input['company_id'] = $company_id;
        $input['company_code'] = $compnayInfo->company_code;
        $input['user_id'] = $compnayInfo->user_id;
        $input['sale_admin'] = $compnayInfo->sale_admin;
        $input['director'] = $userNPP->parent;
        $input['sale_leader'] = $sale->sale_leader;
        $input['distributor_rate'] = $distributor_rate;
        $input['order_status'] = 'new';
        $product = json_encode($request->products);
        $input['products'] = $product;

        if(!is_null($request->show_discount) && $request->show_discount==1){
            $request->validate([
                'discount' => 'required'
            ]);
            $discountPercent = intval($request->discount);
            $percent = $distributor_rate-$discountPercent;
            if($discountPercent>=$distributor_rate){
                $commission = 0;
            }else{
                $commission = $amount*($percent/100);
            }
        }
        $input['commission'] = $commission;

        try {
            //create transaction
            $transaction = $this->tran->create($input);
            //create product transaction
            if(!is_null($request->products)){
                foreach($request->products as $p){
                    $productInfo = Product::find($p);
                    $pro = [
                        'product_id' => $p,
                        'transaction_id' => $transaction->id,
                        'qty' => 1,
                        'amount' => $productInfo->price
                    ];
                    $order = OrderProduct::create($pro);
                }
            }
            //create guest account if not exist
            $company = Company::firstOrCreate(['phone'=>$transaction->phone],
                ['name'=>'Guest',
                    'contact_name'=>$transaction->name,
                    'parent'=>$transaction->company_id,
                    'c_type'=>'guest',
                    'status'=>'pending',
                    'password'=>Hash::make('baohiemoto.vn')
                ]);
            //send telegram sale admin
            $text = "";
            $text .= "Đơn hàng mới từ đại lý <b>" . $compnayInfo->name . " - Mã:" . $compnayInfo->company_code . "</b>\n";
            $text .= "Địa chỉ <b>" . $compnayInfo->address . "</b>\n";
            $text .= "Khách hàng: <b>" . $transaction->name . "</b>\n";
            $text .= "Số điện thoại: <b>" . $transaction->phone . "</b>\n";
            $text .= "Sản phẩm: \n";
            foreach ($transaction->orderProduct as $p) {
                $text .= "" . $p->product->name . "\n";
            }
            $text .= "Ngày hết hạn: <b>" . format_date($transaction->expiry) . "</b>\n";
            $text .= "Biển số xe: <b>" . $transaction->license_plate . "</b>\n";
            $text .= "Chuyên viên: <b>" . $userNPP->full_name . "</b>\n";
            $text .= "<a target='_blank' href='" . \route('wadmin::transaction.edit.get', $transaction->id) . "'>Xem đơn hàng </a>";

            $apiToken = $telegrame_bot_api;


            $data = [
                'chat_id' => $chanelTelegram,
                'parse_mode' => 'HTML',
                'text' => $text
            ];
            $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data));

            return redirect()->route('frontend::product.checkout-success.get');
        }catch (\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }

    }

    public function checkoutSuccess(){
        return view('frontend::customer.products.checkout-success');
    }

    function search(Request $request){
        $name = $request->get('keyword');
        $q = Product::query();

        if (!is_null($name))
        {
            $q = $q->where('name','LIKE', '%'.$name.'%');
        }

        $data = $q->orderBy('created_at','desc')
            ->where('lang_code',$this->lang)
            ->where('main_display',1)
            ->where('status','active')->paginate(15);

        $allCategory = $this->cat->orderBy('sort_order','asc')->findWhere(['status'=>1,'lang_code'=>$this->lang])->all();
        $countProduct = $this->model->findWhere(['lang_code'=>$this->lang,'status'=>'active'])->count();
        return view('frontend::product.search',[
            'data'=>$data,
            'allCategory'=>$allCategory,
            'countProduct'=>$countProduct,
            'name'=>$name
        ]);
    }

}

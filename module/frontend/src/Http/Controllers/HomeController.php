<?php


namespace Frontend\Http\Controllers;


use App\Mail\SendMail;
use Barryvdh\Debugbar\Controllers\BaseController;
use Category\Repositories\CategoryRepository;
use Company\Models\Company;
use Company\Repositories\CompanyRepository;
use Contact\Http\Requests\ContactCreateRequest;
use Contact\Repositories\ContactRepository;
use Gallery\Repositories\GalleryRepository;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Mail;
use Newsletter\Repositories\NewsletterRepository;
use Order\Models\OrderProduct;
use Post\Repositories\PostRepository;
use Product\Models\Product;
use Product\Repositories\CatproductRepository;
use Product\Repositories\ProductRepository;
use Setting\Models\Setting;
use Product\Models\Factory;
use Setting\Repositories\SettingRepositories;
use Telegram\Bot\Laravel\Facades\Telegram;
use Transaction\Http\Requests\TransactionCreateRequest;
use Transaction\Repositories\TransactionRepository;
use Users\Models\Users;

class HomeController extends BaseController
{
    protected $catnews;
    protected $lang;
    protected $cat;
    protected $ga;
    protected $po;
    protected $post;
    protected $tran;
    public function __construct(CategoryRepository $categoryRepository,CatproductRepository $catproductRepository,
                                GalleryRepository $galleryRepository, ProductRepository $productRepository,
                                PostRepository $postRepository, TransactionRepository $transactionRepository)
    {
        $this->lang = session('lang');
        $this->catnews = $categoryRepository;
        $this->cat = $catproductRepository;
        $this->ga = $galleryRepository;
        $this->po = $productRepository;
        $this->post = $postRepository;
        $this->tran = $transactionRepository;
    }

    private $langActive = ['vn','en','ch'];
    public function changeLang(Request $request, $lang){
        if(in_array($lang,$this->langActive)){
            $request->session()->put(['lang'=>$lang]);
            return redirect()->route('frontend::home');
        }
    }
    function getIndex(PostRepository $postRepository){
        $gallery = $this->ga->scopeQuery(function ($e){
            return $e->orderBy('sort_order','asc')
                ->where('status','active')
                ->where('group_id',1);
        })->limit(50);

        $popups = $this->ga->scopeQuery(function ($e){
            return $e->orderBy('sort_order','asc')
                ->where('status','active')
                ->where('group_id',4);
        })->first();

        $category = $this->cat->orderBy('sort_order','asc')->findWhere(['status'=>'active','lang_code'=>$this->lang])->all();


        $listProduct = $this->po->findWhere(['status'=>'active'])->all();
        $listFactory = Factory::orderBy('sort_order','asc')->where('status','active')->get();
        return view('frontend::home.index',[
            'gallery'=>$gallery,
            'popups'=>$popups,
            'listProduct'=>$listProduct,
            'listFactory'=>$listFactory,
            'category'=>$category
        ]);
    }
    public function postBooking(Request $request,SettingRepositories  $settingRepositories){
        $emailSetting = $settingRepositories->getSettingMeta('site_email_vn');
        $input = [
            'name'=>$request->name,
            'phone'=>$request->phone,
            'license_plate'=>$request->license_plate,
            'expiry'=>$request->expiry,
            'message'=>$request->message,
            'factory'=>$request->factory,
            'category'=>$request->category,
            'products'=>json_encode($request->products)
        ];
        $chanelTelegram = 5449285604;
        if(!is_null($request->npp)){
            $nhapp = Company::where('company_code',$request->npp)->first();
            $userNPP = Users::where('id',$nhapp->user_id)->first();
            $sale = Users::where('id',$userNPP->sale_admin)->first();
            if(!is_null($sale)){
                $chanelTelegram = $sale->telegram;
            }
            $input['user_id'] = $nhapp->user_id;
            $input['company_id'] = $nhapp->id;
            $input['company_code'] = $request->npp;
            $input['sale_admin'] = $userNPP->sale_admin;
        }else{
            return response()->json(['error'=>'Đặt hàng không thành công']);
        }
        $input['order_status'] = 'pending';
        $transaction = $this->tran->create($input);
        $totallamount = 0;
        foreach($request->products as $p){
            $productInfo = Product::find($p);
            $totallamount = $totallamount + $productInfo->price;
            $pro = [
                'product_id'=>$p,
                'transaction_id'=>$transaction->id,
                'qty'=>1,
                'amount'=>$productInfo->price
            ];
            $order = OrderProduct::create($pro);
        }
        $amountUp = ['amount'=>$totallamount];
        $updateAmount = $this->tran->update($amountUp,$transaction->id);

        $text = "";
        $text .= "Đơn hàng mới từ đại lý <b>".$nhapp->name." - Mã:".$nhapp->company_code."</b>\n";
        $text .= "Địa chỉ <b>".$nhapp->address."</b>\n";
        $text .= "Khách hàng: <b>".$transaction->name."</b>\n";
        $text .= "Số điện thoại: <b>".$transaction->phone."</b>\n";
        $text .= "Sản phẩm: \n";
        foreach($transaction->orderProduct as $p){
            $text .= "".$p->product->name."\n";
        }
        $text .= "Ngày hết hạn: <b>".format_date($transaction->expiry)."</b>\n";
        $text .= "Biển số xe: <b>".$transaction->license_plate."</b>\n";
        $text .= "Chuyên viên: <b>".$userNPP->full_name."</b>\n";
        $text .= "<a target='_blank' href='".\route('wadmin::transaction.edit.get',$transaction->id)."'>Xem đơn hàng </a>";

        Telegram::sendMessage([
            'chat_id' => 1049968534,
            'parse_mode' => 'HTML',
            'text' => $text
        ]);

//       Mail::to($emailSetting)
//           ->send(new SendMail($transaction));
        return response()->json($transaction);
    }

    public function thankyou(){
    	return view('frontend::home.thankyou');
    }

    public function contact(SettingRepositories $settingRepositories){
        return view('frontend::contact.contact');
    }
    public function postContact(ContactCreateRequest $request, ContactRepository $contactRepository, SettingRepositories $settingRepositories){
            $emailSetting = $settingRepositories->getSettingMeta('site_email_vn');
            $input = $request->except(['_token']);
            $data = [
                'title'=>$input['title'],
                'name'=>$input['name'],
                'phone'=>$input['phone'],
                'messenger'=>$input['messenger']
            ];
            $contactRepository->create($data);
            $details = [
                'name'=> $input['name'],
                'phone'=> $input['phone'],
                'title'=>$input['title'],
                'messenger'=>$input['messenger']
            ];
            Mail::to($emailSetting)
                ->send(new SendMail($details));
//            Mail::send('frontend::mail.contact',['name'=>$input['name'],'email'=>$input['email'],'title'=>$input['title'],'messenger'=>$input['messenger']],
//                function ($message){
//                    $message->to('thanhan1507@gmail.com', 'Visitor')->subject('Liên hệ từ website viện nghiên cứu !');
//                });
            return view('frontend::contact.success',['data'=>$input]);
    }

    public function zalo(Request $request){
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'secret_key' => "Akw26QTUz8EYZ5i3JwGj",
            ]
        ]);
        $app_id = '726851519957413814';
        $code = $request->code;
        $url = "https://oauth.zaloapp.com/v4/oa/access_token?app_id=$app_id&code=$code&grant_type=authorization_code&code_verifier=7f7de30229a6edab8bc968ac7b7bcafa117691c20a59cd8db2471d19a53eba34";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        try {
            $responses = json_decode($response, true);
            return $responses;
        }catch (\Exception $e){
            return response()->json($e->getMessage());
        }

    }


}

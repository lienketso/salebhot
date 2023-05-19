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
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Mail;
use Newsletter\Repositories\NewsletterRepository;
use Post\Repositories\PostRepository;
use Product\Repositories\CatproductRepository;
use Product\Repositories\ProductRepository;
use Setting\Models\Setting;
use Setting\Repositories\SettingRepositories;
use Transaction\Http\Requests\TransactionCreateRequest;
use Transaction\Repositories\TransactionRepository;

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

        $pageAbout = $postRepository->findWhere(['lang_code'=>$this->lang,'status'=>'active','display'=>1,'post_type'=>'page'])->first();

        $latestNews = $postRepository->scopeQuery(function($e){
            return $e->orderBy('created_at','desc')
                ->where('lang_code',$this->lang)
                ->where('status','active')
                ->where('post_type','blog')
                ->get();
        })->limit(5);

        //Tin Slider
        $sliderNews= $postRepository->scopeQuery(function ($e){
            return $e->orderBy('created_at','asc')
                ->where('status','active')
                ->where('post_type','blog')
                ->where('lang_code',$this->lang)
                ->where('display',3)->get();
        })->limit(20);

        //danh mục tin trang chủ
        $catnewsHome = $this->catnews->with(['childs'=>function($e){
            return $e->where('display',1);
        },'postCat','postHot'])->scopeQuery(function($e){
            return $e->orderBy('sort_order','asc')
                ->where('parent',0)
                ->where('status','active')
                ->where('lang_code',$this->lang)
                ->where('display',1)->get();
        })->limit(10);

        $catBottom = $this->catnews->with(['childs'])->scopeQuery(function($e){
            return $e->orderBy('sort_order','asc')
                ->where('parent',0)
                ->where('status','active')
                ->where('lang_code',$this->lang)
                ->where('display',1)->get();
        })->limit(10);


        return view('frontend::home.index',[
            'gallery'=>$gallery,
            'sliderNews'=>$sliderNews,
            'catBottom'=>$catBottom,
            'latestNews'=>$latestNews,
            'pageAbout'=>$pageAbout,
            'catnewsHome'=>$catnewsHome,
            'popups'=>$popups
        ]);
    }
    public function about(SettingRepositories $settingRepositories, PostRepository $postRepository){
        $checkList = $settingRepositories->getSettingMeta('about_section_list_1_title_'.$this->lang);
        $decodeCheck = json_decode($checkList);
        $decodeCheck = array_chunk($decodeCheck,4);

        //page to page
        $pageList = $postRepository->scopeQuery(function($e){
            return $e->orderBy('created_at','desc')
                ->where('status','active')
                ->where('lang_code',$this->lang)
                ->where('display',3);
        })->limit(5);

        return view('frontend::home.about',['decodeCheck'=>$decodeCheck,'pageList'=>$pageList]);
    }

    public function postBooking(Request $request,SettingRepositories  $settingRepositories){
        $emailSetting = $settingRepositories->getSettingMeta('site_email_vn');
        $input = [
            'name'=>$request->name,
            'user_id'=>0,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'license_plate'=>$request->license_plate,
            'expiry'=>$request->expiry,
            'message'=>$request->message,
            'products'=>json_encode($request->products)
        ];
        if(!is_null($request->npp)){
            $nhapp = Company::where('company_code',$request->npp)->first();
            $input['company_id'] = $nhapp->id;
            $input['company_code'] = $request->npp;
        }
         $transaction = $this->tran->create($input);
//        Mail::to($emailSetting)
//            ->send(new SendMail($transaction));
        return response()->json($transaction);
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

    public function createNewletter(Request $request, NewsletterRepository $newsletterRepository){
        $email = $request->get('email');
        $input = ['email'=>$email];
        $newsletterRepository->create($input);
        echo 'Subscribe successful !';
    }

    public function createPartner(TransactionCreateRequest $request, TransactionRepository $transactionRepository){
        $input = $request->except(['_token']);
        try{
            $create = $transactionRepository->create($input);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

}

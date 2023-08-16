<?php


namespace Base\Http\Controllers;


use App\ZaloZNS;
use Barryvdh\Debugbar\Controllers\BaseController;
use Company\Models\Company;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use League\Flysystem\Exception;
use Post\Repositories\PostRepository;
use Setting\Models\Setting;
use Setting\Repositories\SettingRepositories;
use Transaction\Models\Transaction;
use Zalo\Zalo;
use Zalo\ZaloEndPoint;

class DashboardController extends BaseController
{

    function getIndex(PostRepository $postRepository, SettingRepositories $settingRepositories){

        $productview = $postRepository->orderBy('count_view','desc')->where('post_type','product')
            ->where(['lang_code'=>session('lang')])->limit(8)->get();
        $settingHome = $settingRepositories;

        $newTransaction = Transaction::orderBy('created_at','desc')->limit(10)->get();
        $newCompany = Company::where('status','!=','disable')->where('c_type','distributor')->orderBy('updated_at','desc')->limit(10)->get();

        return view('wadmin-dashboard::dashboard',['newTransaction'=>$newTransaction,'newCompany'=>$newCompany,'settingHome'=>$settingHome]);
    }

    public function postIndex(Request $request, SettingRepositories $settingRepositories){
        $input = $request->except(['_token']);
        $number = $request->post('list_number');
        $settingRepositories->saveSetting($input);
        return redirect()->back();
    }

    private $langActive = ['vn','en','ch'];

    public function changeLang(Request $request, $lang){
        if(in_array($lang,$this->langActive)){
            $request->session()->put(['lang'=>$lang]);
            return redirect()->back();
        }
    }

    function upload(Request $request){
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $path = date('Y').'/'.date('m').'/'.date('d');

            $request->file('upload')->move(public_path('upload/'.$path.'/'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');

            $url = asset('upload/'.$path.'/'.$fileName);

            $msg = 'Tải ảnh lên thành công !';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function addFeedback(Request $request)
    {
        $input['name'] = 'Nguyễn Thành An';
        $input['email'] = 'thanhan1507@gmail.com';
        $input['comment'] = 'Tôi thử test email xem sao';
        Mail::send('wadmin-dashboard::temps.mail', array('name'=>$input["name"],'email'=>$input["email"], 'content'=>$input['comment']), function($message){
            $message->to('thanhan1507@gmail.com', 'Visitor')->subject('Visitor Feedback!');
        });
        return 'Send successful';
    }

    public function sendZns(){
        $phone = '0979823452';
        $templateId = '263030';
        $params = [
            'note'=>'Đã tiếp nhận',
            'Number_a' => '2042DD',
            "oder_name"=>'Nguyễn Thành An',
            'Product'=>'Bảo hiểm trách nhiệm dân sự',
            'customer_name' => 'Nhà phân phối Wiseman',
            'oder_number'=>'0985548328',
            ];

        $zaloZns = new ZaloZNS();
        $zaloZns->sendZaloMessage($templateId,$phone,$params);

    }

    public function getAccessToken()
    {
        $setting = Setting::where('setting_key','zalo_refresh_token')->first();
        $secretKey = env('ZALO_SECRET_KEY');
        $code_verifier = bin2hex(random_bytes(32));
        $code_challenge = base64_url_encode_zalo(hash('sha256', $code_verifier, true));
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'secret_key' => "${secretKey}",
            ]
        ]);
        $response = $client->post('https://oauth.zaloapp.com/v4/oa/access_token', [
            'form_params' => [
                'app_id' => env('ZALO_OA_ID'),
                'grant_type' => 'refresh_token',
                'refresh_token'=>$setting->setting_value,
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        Setting::updateOrCreate(['setting_key'=>'zalo_refresh_token'],['setting_value'=>$data['refresh_token']]);

        return $data['access_token'];

    }


}

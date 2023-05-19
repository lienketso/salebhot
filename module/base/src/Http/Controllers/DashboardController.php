<?php


namespace Base\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Post\Repositories\PostRepository;
use Setting\Repositories\SettingRepositories;

class DashboardController extends BaseController
{

    function getIndex(PostRepository $postRepository, SettingRepositories $settingRepositories){
        $postview = $postRepository->orderBy('count_view','desc')->where('post_type','blog')
            ->where(['lang_code'=>session('lang')])->limit(8)->get();
        $productview = $postRepository->orderBy('count_view','desc')->where('post_type','product')
            ->where(['lang_code'=>session('lang')])->limit(8)->get();
        $settingHome = $settingRepositories;

        return view('wadmin-dashboard::dashboard',['postview'=>$postview,'productview'=>$productview,'settingHome'=>$settingHome]);
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
        return 'Send successful'; die;
    }


}

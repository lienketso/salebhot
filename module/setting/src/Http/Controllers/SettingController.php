<?php


namespace Setting\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Setting\Models\Setting;
use Setting\Repositories\SettingRepositories;

class SettingController extends BaseController
{
    protected $model;
    protected $langcode;
    public function __construct(SettingRepositories $settingRepositories)
    {
        $this->model = $settingRepositories;
        $this->langcode = session('lang');
    }

    public function getIndex(Request $request){
        $setting = $this->model;
        $langcode = $this->langcode;
        return view('wadmin-setting::index',['setting'=>$setting,'language'=>$langcode]);
    }

    public function getFact(){
        $setting = $this->model;
        $langcode = $this->langcode;
        return view('wadmin-setting::fact',['setting'=>$setting,'language'=>$langcode]);
    }

    public function getKeyword(){
        $setting = $this->model;
        $langcode = $this->langcode;
        return view('wadmin-setting::keyword',['setting'=>$setting,'language'=>$langcode]);
    }

    public function getAbout(){
        $setting = $this->model;
        $langcode = $this->langcode;
        $check = $this->model->getSettingMeta('about_section_list_1_title_'.$langcode);

        $checkList = json_decode($check);
        return view('wadmin-setting::about',['setting'=>$setting,'language'=>$langcode,'checkList'=>$checkList]);
    }

    public function postAbout(Request $request){
        $langcode = $this->langcode;
        $data = $request->except('_token');
//        if($request->hasFile('about_banner_page')){
//            $image = $request->about_banner_page;
//            $path = date('Y').'/'.date('m').'/'.date('d');
//            $data['about_banner_page'] = $path.'/'.$image->getClientOriginalName();
//            $image->move('upload/'.$path,$image->getClientOriginalName());
//        }
        $data['about_banner_page'] = replace_thumbnail($data['about_banner_page']);
        $data['about_section_1_img'] = replace_thumbnail($data['about_section_1_img']);
        $data['about_section_2_img'] = replace_thumbnail($data['about_section_2_img']);
        $data['about_section_3_img'] = replace_thumbnail($data['about_section_3_img']);

        $about_title = $data['about_section_list_1_title_'.$langcode];
        $data['about_section_list_1_title_'.$langcode] = json_encode($about_title);


        $this->saveSetting($data);
        return redirect()->back()->with('edit','Sửa cấu hình thành công !');
    }

    public function saveSetting($data){
        foreach($data as $key=>$val){
            Setting::updateOrCreate(['setting_key'=>$key],['setting_value'=>$val]);
        }
    }

    public function postIndex(Request $request){
        $data = $request->except('_token');

        $data['site_logo'] = replace_thumbnail($data['site_logo']);
        $data['site_profile'] = replace_thumbnail($data['site_profile']);
        $data['banner_contact'] = replace_thumbnail($data['banner_contact']);
        $this->saveSetting($data);
        return redirect()->back()->with('edit','Sửa cấu hình thành công !');
    }

    public function postFact(Request $request){
        $data = $request->except(['_token']);
        $data['fact_image'] = replace_thumbnail($data['fact_image']);
        $data['fact_background'] = replace_thumbnail($data['fact_background']);

        $this->saveSetting($data);
        return redirect()->back()->with('edit','Sửa cấu hình thành công !');
    }

    public function postKeyword(Request $request){
        $data = $request->except('_token');
        $this->saveSetting($data);
        return redirect()->back()->with('edit','Sửa cấu hình thành công !');
    }


}

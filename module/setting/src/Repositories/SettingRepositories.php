<?php


namespace Setting\Repositories;


use Setting\Models\Setting;

class SettingRepositories
{
    public function model(){
        return Setting::class;
    }

    public function getSettingMeta($key)
    {
        $data = collect(['setting_value' => '']);
        $setting = Setting::where('setting_key',$key)->first();
        if (!empty($setting)) {
            $data = $setting->setting_value;
        }else{
            $data = 'null';
        }
        return $data;
    }

    public function getAllSetting()
    {
        $settings = Setting::all([
            'setting_key', 'setting_value'
        ]);

        $result = [];

        foreach ($settings as $s) {
            $result[$s->setting_key] = $s->setting_value;
        }

        return $result;
    }

    public function saveSetting($data){
        foreach($data as $key=>$val){
            Setting::updateOrCreate(['setting_key'=>$key],['setting_value'=>$val]);
        }
    }


}

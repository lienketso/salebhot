<?php

namespace ZaloZns\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ZaloZnsCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required',
            'template_number'=>'required|unique:zalo_template',
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập tên template',
            'template_number.required'=>'Vui lòng nhập số id template',
            'template_number.unique'=>'Số id template đã có trong hệ thống',
        ];
    }
}

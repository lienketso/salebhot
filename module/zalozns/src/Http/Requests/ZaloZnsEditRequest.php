<?php

namespace ZaloZns\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZaloZnsEditRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required',
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập tên template',
            'template_number.required'=>'Vui lòng nhập số id template',
        ];
    }
}

<?php

namespace Discounts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountsCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required',
            'value'=>'required|numeric'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập tiêu đề',
            'value.required'=>'Bạn chưa nhập tỷ lệ %',
            'value.numeric'=>'Tỷ lệ phải là một số'
        ];
    }
}

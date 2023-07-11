<?php

namespace Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeatsEditRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'seat'=> 'required|numeric'
        ];
    }

    public function messages(){
        return [
            'seat.required'=>'Bạn chưa nhập số chỗ',
            'seat.numeric'=>'Số chỗ phải là 1 số'
        ];
    }
}

<?php

namespace Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeatsCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required',
            'seat'=> 'required|unique:seats|numeric'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập tiêu đề',
            'seat.required'=>'Bạn chưa nhập số chỗ',
            'seat.unique'=>'Số chỗ đã tạo trước đó',
            'seat.numeric'=>'Số chỗ phải là 1 số'
        ];
    }
}

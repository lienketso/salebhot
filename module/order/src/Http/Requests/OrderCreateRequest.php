<?php


namespace Order\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }
    public function rules(){
        return [
            'customer'=> 'required',
            'phone'=> 'required|numeric',
        ];
    }

    public function messages(){
        return [
            'customer.required'=>'Vui lòng nhập họ tên',
            'phone.required'=>'Vui lòng nhập số điện thoại',
            'phone.numeric'=>'Số điện thoại không đúng định dạng',
        ];
    }
}

<?php


namespace Transaction\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class TransactionCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required',
            'phone'=>'required|numeric',
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập họ tên',
            'phone.required'=>'Bạn chưa nhập số điện thoại',
            'phone.numeric'=>'Số điện thoại không đúng định dạng',
        ];
    }
}

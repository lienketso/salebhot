<?php


namespace Contact\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ContactCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required',
            'phone'=>'required'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập họ tên',
            'phone.required'=>'Bạn chưa nhập số điện thoại',
        ];
    }
}

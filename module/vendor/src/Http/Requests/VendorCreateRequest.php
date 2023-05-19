<?php


namespace Vendor\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class VendorCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required|unique:product,name'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập tên sản phẩm',
            'name.unique'=>'Tên sản phẩm đã được đặt trước đó'
        ];
    }

}

<?php


namespace Product\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CatCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required|unique:catproduct,name'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập tên danh mục',
            'name.unique'=>'Tên danh mục đã được đặt trước đó'
        ];
    }
}

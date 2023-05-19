<?php


namespace Product\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required|unique:product,name',
            'cat_id'=>'required'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập tên sản phẩm',
            'name.unique'=>'Tên sản phẩm đã được đặt trước đó',
            'cat_id.required'=>'Danh mục sản phẩm bắt buộc chọn'
        ];
    }

}

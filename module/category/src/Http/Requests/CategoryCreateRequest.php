<?php


namespace Category\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required|unique:category,name'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập tên danh mục',
            'name.unique'=>'Danh mục đã tồn tại'
        ];
    }
}

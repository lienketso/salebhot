<?php


namespace Post\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required|unique:post,name'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập tiêu đề',
            'name.unique'=>'Tiêu đề đã được đặt trước đó'
        ];
    }

}

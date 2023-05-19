<?php


namespace Setting\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class LinkCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required',
            'link'=> 'required'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập tiêu đề link',
            'link.required'=>'Bạn chưa nhập link'
        ];
    }
}

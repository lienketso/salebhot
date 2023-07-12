<?php


namespace Expert\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ExpertCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required',
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập tên nhà phân phối',
        ];
    }

}

<?php


namespace Newsletter\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class NewsletterCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'email'=> 'required|email',
        ];
    }

    public function messages(){
        return [
            'email.required'=>'Bạn chưa nhập email',
            'email.email'=>'Email không đúng định dạng'
        ];
    }
}

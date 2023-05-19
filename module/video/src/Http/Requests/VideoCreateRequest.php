<?php


namespace Video\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class VideoCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required|unique:post,name',
            'description'=> 'required'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập tiêu đề',
            'name.unique'=>'Tiêu đề đã được đặt trước đó',
            'description.required'=> 'Link video chưa đúng định dạng'
        ];
    }

}

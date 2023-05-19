<?php


namespace Video\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class VideoEditRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required',
            'description'=> 'required'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Bạn chưa nhập tiêu đề',
            'description.required'=> 'Link video chưa đúng định dạng'
        ];
    }
}

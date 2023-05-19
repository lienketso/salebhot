<?php


namespace Users\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UsersCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'email'=> 'required|email|unique:users,email',
            'password'=>'required|min:4',
            're_password'=>'required|same:password',
            'full_name'=>'required'
        ];
    }

    public function messages(){
        return [
            'email.required'=>'Bạn chưa nhập email',
            'email.email'=>'Email không đúng định dạng',
            'email.unique'=>'Email đã được sử dụng',
            'password.required'=>'Mật khẩu bắt buộc nhập',
            'password.min'=>'Mật khẩu phải lớn hơn 4 ký tự',
            're_password.required'=>'Xác nhận mật khẩu bắt buộc nhập',
            're_password.same'=>'Mật khẩu không khớp',
            'full_name.required'=>'Họ tên bắt buộc nhập'
        ];
    }

}

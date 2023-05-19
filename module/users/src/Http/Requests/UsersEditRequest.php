<?php


namespace Users\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UsersEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            're_password' => 'same:password',
            'full_name' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            're_password.same' => 'Mật khẩu nhắc lại không khớp',
            'full_name.required' => 'Họ và tên không được bỏ trống'
        ];
    }
}

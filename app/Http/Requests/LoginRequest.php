<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email'=>'required|email',
            'password'=>'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'email.required'=>'Email không được để trống',
            'email.email'=>'Tài khoản là email',
            'password.required'=>'Mật khẩu không được để trống',
            'password.min'=>'Mật khẩu phải ít nhất 6 kí tự'
        ];
    }
}

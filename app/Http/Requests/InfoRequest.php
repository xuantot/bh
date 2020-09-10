<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfoRequest extends FormRequest
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
            'full'=>'required|min:5',
            'phone'=>'required',
            'address'=>'required|min:5',
            'password'=>'required|min:5',
        ];
    }
    public function messages()
    {
        return [
            'full.required'=>'Họ và tên không được để trống!',
            'full.min'=>'Họ và tên ít nhất 5 ký tự!',
            'phone.required'=>'Số điện thoại không được để trống!',
            'address.required'=>'Địa chỉ không được để trống!',
            'address.min'=>'Địa chỉ ít nhất 5 ký tự!',
            'password.required'=>'Mật khẩu không được để trống!',
            'password.min'=>'Mật khẩu ít nhất 5 ký tự!'
        ];
    }
}

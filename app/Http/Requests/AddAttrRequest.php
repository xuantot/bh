<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAttrRequest extends FormRequest
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
            'pro_name'=>'required|unique:attribute,name'
        ];
    }
    public function messages()
    {
        return [
            'pro_name.required'=>'Tên thuộc tính không được để trống!',
            'pro_name.unique'=>'Tên thuộc tính đã tồn tại!'
        ];
    }
}

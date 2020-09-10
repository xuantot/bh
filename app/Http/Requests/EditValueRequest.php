<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditValueRequest extends FormRequest
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
            'edit_value_name'=>'required|unique:values,value'
        ];
    }
    public function messages()
    {
        return [
           'edit_value_name.required'=>'Giá trị thuộc tính không được để trống!',
           'edit_value_name.unique'=>'Giá trị thuộc tính đã tồn tại!'
        ];
    }
}

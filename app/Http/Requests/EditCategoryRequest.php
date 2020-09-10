<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoryRequest extends FormRequest
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
            'name'=>'required|min:3'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Tên danh mục không được để trông!',
            'name.min'=>'Tên danh mục phải ít nhất 3 kí tự!'
        ];
    }
}

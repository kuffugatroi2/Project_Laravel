<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeItemRequest extends FormRequest
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
            'item_name' => 'required|unique:tbl_item_type,item_name'
        ];
    }

    public function messages()
    {
        return [
            'item_name.required' => "Tên loại sản phẩm không được trống!",
            'item_name.unique' => "Loại sản phẩm này đã tồn tại!"
        ];
    }
}

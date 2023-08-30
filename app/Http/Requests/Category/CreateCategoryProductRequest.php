<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryProductRequest extends FormRequest
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
            'category_product_name' => 'required|unique:tbl_category_product,category_name',
        ];
    }

    public function messages()
    {
        return [
            'category_product_name.required' => "Tên thể loại sản phẩm không được trống!",
            'category_product_name.unique' => "Thể loại sản phẩm này đã tồn tại!",
        ];
    }
}

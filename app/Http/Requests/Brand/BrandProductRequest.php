<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class BrandProductRequest extends FormRequest
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
            'brand_product_name' => 'required|unique:tbl_brand,brand_name',
        ];
    }

    public function messages()
    {
        return [
            'brand_product_name.required' => "Tên thương hiệu không được trống!",
            'brand_product_name.unique' => "Thương hiệu này đã tồn tại!",
        ];
    }
}

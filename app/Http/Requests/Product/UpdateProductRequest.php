<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'product_name' => 'required|min:5',
            'product_price' => 'required',
            'product_quantity' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => "Tên sản phẩm không được trống!",
            'product_name.min' => "Tên sản phẩm không được dưới 5 từ!",
            'product_price.required' => 'Giá sản phẩm không được trống!',
            'product_quantity.required' => 'Số lượng sản phẩm không được trống!'
        ];
    }
}

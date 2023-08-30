<?php

namespace App\Http\Requests\Shipping;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShippingRequest extends FormRequest
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
            'shipping-name' => 'required',
            'shipping-address' => 'required',
            'shipping-phone' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'shipping-name.required' => 'Tên không được trống!',
            'shipping-address.required' => 'Địa chỉ không được trống!',
            'shipping-phone.required' => "Số điện thoại không được trống!",
            'shipping-phone.numeric' => "Số điện thoại phải ở dạng số!"
        ];
    }
}

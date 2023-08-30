<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCheckoutCustomerRequest extends FormRequest
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
            'shipping-first-name' => 'required',
            'shipping-last-name' => 'required',
            'shipping-address' => 'required',
            // 'shipping-email' => 'required|email',
            'shipping-phone' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'shipping-first-name.required' => "Họ Không được trống!",
            'shipping-last-name.required' => 'Tên không được trống!',
            'shipping-address.required' => 'Địa chỉ không được trống!',
            // 'shipping-email.required' => "Email không được trống",
            // 'shipping-email.email' => "Không đúng định dạng email!",
            'shipping-phone.required' => "Số điện thoại không được trống!",
            'shipping-phone.numeric' => "Số điện thoại phải ở dạng số!"
        ];
    }
}

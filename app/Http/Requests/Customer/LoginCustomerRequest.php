<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class LoginCustomerRequest extends FormRequest
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
            'customer-email' => 'required|email',
            'customer-password' => 'required|min:6|max:15'
        ];
    }

    public function messages()
    {
        return [
            'customer-email.required' => "Email Không được trống!",
            'customer-email.email' => "Không đúng định dạng email!",
            'customer-password.required' => 'Mật khẩu không được trống!',
            'customer-password.min' => 'Độ dài của mật khẩu không được ngắn hơn 6 ký tự!',
            'customer-password.max' => 'Độ dài của mật khẩu không được dài hơn 15 ký tự!',
        ];
    }
}

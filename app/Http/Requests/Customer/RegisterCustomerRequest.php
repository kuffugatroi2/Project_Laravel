<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCustomerRequest extends FormRequest
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
            'customer-name' => 'required',
            'customer-email' => 'required|email|unique:tbl_customers,customer_name',
            'customer-password' => 'required|min:6|max:15',
            'customer-password-again' => 'same:customer-password',
            'customer-phone' => 'numeric'
        ];
    }

    public function messages()
    {
        return [
            'customer-name.required' => "Tên không được trống!",
            'customer-email.required' => "Email Không được trống!",
            'customer-email.email' => "Không đúng định dạng email!",
            'customer-email.unique' => "Email này đã tồn tại!",
            'customer-password.required' => 'Mật khẩu không được trống!',
            'customer-password.min' => 'Độ dài của mật khẩu không được ngắn hơn 6 ký tự!',
            'customer-password.max' => 'Độ dài của mật khẩu không được dài hơn 15 ký tự!',
            'customer-password-again.same' => 'Nhập lại mật khẩu không trùng!',
            'customer-phone.numeric' => 'Số điện thoại phải ở dạng số!'
        ];
    }
}

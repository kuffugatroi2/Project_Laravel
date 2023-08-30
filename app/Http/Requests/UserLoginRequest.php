<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'admin_email' => 'required',
            'admin_password' => 'required|min:4|max:20'
        ];
    }

    public function messages()
    {
        return [
            'admin_email.required' => 'Bạn chưa nhập Email',
            'admin_password.required' => 'Bạn chưa nhập Password',
            'admin_password.min' => 'Lỗi! Password ngắn hơn 4 ký tự',
            'admin_password.max' => 'Lỗi! Password dài hơn 20 ký tự',
        ];
    }
}

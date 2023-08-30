<?php

namespace App\Http\Requests\AcountAdmin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAcountAdminRequest extends FormRequest
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
            'name' => 'required|min:5',
            'password' => 'min:6|max:15',
            'password-again' => 'same:password',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Tên không được trống!",
            'name.min' => "Tên không được ngắn dưới 5 ký tự!",
            'password.min' => "Mật khẩu không được ngắn dưới 6 ký tự",
            'password.max' => "Mật khẩu không được dài hơn 15 ký tự",
            'password-again.same' => "Mật khẩu không khớp nhau!"
        ];
    }
}

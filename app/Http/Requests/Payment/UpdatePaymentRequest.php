<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
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
            'payment-method' => 'required',
            'payment-description' => 'required|min:20'
        ];
    }

    public function messages()
    {
        return [
            'payment-method.required' => "Tên Phương thức không được trống!",
            'payment-description.required' => 'Mô tả phương thức không được trống!',
            'payment-description.min' => 'Độ dài của mô tả không được ngắn hơn 20 ký tự!'
        ];
    }
}

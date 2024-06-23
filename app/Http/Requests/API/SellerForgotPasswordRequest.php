<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class SellerForgotPasswordRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'phone' => 'required|numeric|regex:/^01[0125]\d{8}$/|exists:stores,phone'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function messages()
    {
        return [
            'phone.required' => 'Phone is required',
            'phone.numeric' => 'Phone must be numeric',
            'phone.regex' => 'Invalid phone number',
            'phone.exists' => 'Phone is not registered yet'
        ];
    }
}

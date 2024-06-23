<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomerRegisterRequest extends FormRequest
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
            'name'=>'required|string|min:4|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6|max:255',
            'phone' => 'required|numeric|regex:/^01[0125]\d{8}$/|unique:users,phone'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            SendResponse(422, "The data you've passed isn't validated", $validator->errors())
        );
    }
}

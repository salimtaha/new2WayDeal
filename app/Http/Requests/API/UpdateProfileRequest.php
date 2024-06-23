<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('sanctum')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string',
            'governorate_id' => 'required|exists:governorates,id',
            'city_id' => 'required|exists:cities,id',
        ];

        if ($this->routeIs('customer.update')) {
            $rules['email'] = 'required|email|unique:users,email,'.auth('sanctum')->id();
            $rules['phone'] = 'required|numeric|unique:users,phone,'.auth('sanctum')->id();
        }elseif ($this->routeIs('seller.update')) {
            $rules['email'] = 'required|email|unique:stores,email,'.auth('sanctum')->id();
            $rules['phone'] = 'required|numeric|unique:stores,phone,'.auth('sanctum')->id();
        }

        return $rules;
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            SendResponse(422, "The data you've passed isn't validated", $validator->errors())
        );
    }
}

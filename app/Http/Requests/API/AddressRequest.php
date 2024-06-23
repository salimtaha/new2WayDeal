<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->guard('sanctum')->check() && auth('sanctum')->user()->email_verified_at !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $data = [];
        $data['governorate_id'] = 'required|exists:governorates,id';
        $data['city_id'] = 'required|exists:cities,id';

        if(request()->hasFile('image'))
        {
            $data['image'] = 'required|image|mimes:png,jpg,jpeg';
        }

        return $data;
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            SendResponse(422, "The data you've passed isn't validated", $validator->errors())
        );
    }
}

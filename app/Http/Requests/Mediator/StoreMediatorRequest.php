<?php

namespace App\Http\Requests\Mediator;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMediatorRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'user_name' => ['required', 'string', 'min:3', 'max:50', 'unique:mediators,user_name,' . ($this->id ?? 'NULL') . ',id'],
            'email' => ['required', 'unique:mediators,email,' . ($this->id ?? 'NULL') . ',id'],
            'password' => ['required', 'confirmed', 'min:8', 'max:30'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];

    }
}

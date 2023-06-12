<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class EditUserAPIRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()

        ]));
    }
    public function rules(): array
    {
        return [
            'email' => 'required|min:6|email|unique:listuser,email,'.$this->id.',id',
            'phone' => 'unique:listuser,phone|required|min:10|max:10'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email required',
            'email.email' => 'Email format incorrect',
            'email.min' => 'Emain min: 6 characters',
            'email.unique' => 'Email already taken',
        ];
    }
}

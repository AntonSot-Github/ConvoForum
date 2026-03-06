<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone' => ['nullable', 'regex:/^\+?[0-9\s\-]{7,20}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'Phone number must contain only digits, spaces, + or - symbols.',
        ];
    }
}

<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'content' => ['required', 'string'],
            'userPicture' => ['nullable', 'image', 'max:2048'],
            'topic_mode' => ['required', 'in:new,existing'],
            'new_topic_title' => ['required_if:topic_mode,new'],
            'existing_topic_id' => ['required_if:topic_mode,existing', 'exists:topics,id'],
        ];
    }
}

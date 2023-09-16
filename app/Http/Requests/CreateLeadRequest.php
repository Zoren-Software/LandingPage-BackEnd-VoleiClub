<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLeadRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'email' => [
                'unique:leads,email',
                'required',
            ],
            'name' => [
                'required',
                'string',
            ],
            'experience_level' => [
                'required',
            ],
            'message' => [
                'string',
                'sometimes',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => __('Leads.email.unique'),
            'email.required' => __('Leads.email.required'),
            'name.required' => __('Leads.name.required'),
            'experience_level.required' => __('Leads.experience_level.required'),
            'message.string' => __('Leads.message.string'),
        ];
    }
}

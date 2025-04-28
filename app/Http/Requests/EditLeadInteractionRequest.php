<?php

namespace App\Http\Requests;

use App\Http\Requests\Interfaces\ScribeInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditLeadInteractionRequest extends FormRequest implements ScribeInterface
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
            'status_id' => [
                'required',
                'integer',
                'exists:leads_status,id',
            ],
            'message' => [
                'nullable',
                'string',
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'lead.required' => __('Leads.lead_required'),
            'lead.string' => __('Leads.lead_string'),
            'lead.unique' => __('Leads.lead_unique'),
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'status_id' => [
                'description' => 'The status of the interaction',
                'example' => '1',
                'required' => true,
            ],
            'message' => [
                'description' => 'The message of the interaction',
                'example' => 'Hello, how are you? I am contacting you to talk about our product.',
            ],
            'notes' => [
                'description' => 'The notes of the interaction',
                'example' => 'This is a note about the interaction.',
            ],
        ];

    }
}

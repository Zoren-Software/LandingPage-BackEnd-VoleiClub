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
            //'status' => 'required|in:new,contacted,converted,unqualified,qualified,bad_email,spam',
            'status' => [
                'required',
                'string',
                Rule::in([
                    'new',
                    'contacted',
                    'converted',
                    'unqualified',
                    'qualified',
                    'bad_email',
                    'spam',
                    'test',
                    'trial_period',
                    'active_customer',
                ]),
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
            'email' => [
                'description' => __('Leads.email_description'),
                'required' => true,
                'value' => 'test@test.com',
            ],
            'name' => [
                'description' => __('Leads.name_description'),
                'required' => true,
                'value' => 'John Doe',
            ],
            'experience_level' => [
                'description' => __('Leads.experience_level_description'),
                'required' => true,
                'value' => 'beginner',
            ],
            'message' => [
                'description' => __('Leads.message_description'),
                'required' => false,
                'value' => 'Hello, I am interested in your services.',
            ],
            'recaptchaToken' => [
                'description' => __('Leads.recaptchaToken_description'),
                'required' => true,
                'value' => 'test',
            ],
        ];

    }
}

<?php

namespace App\Http\Requests;

use App\Http\Requests\Interfaces\ScribeInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlterStatusLeadRequest extends FormRequest implements ScribeInterface
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
            'id' => [
                'required',
                'integer',
                'exists:leads,id',
            ],
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
            'id.required' => __('Leads.id_required'),
            'id.integer' => __('Leads.id_integer'),
            'id.exists' => __('Leads.id_exists'),
            'status.required' => __('Leads.status_required'),
            'status.string' => __('Leads.status_string'),
            'status.in' => __('Leads.status_in'),
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'id' => [
                'description' => __('Leads.id_description'),
                'required' => true,
                'example' => 1,
            ],
            'status' => [
                'description' => __('Leads.status_description'),
                'required' => true,
                'example' => 'new',
            ],
            'message' => [
                'description' => __('Leads.message_description'),
                'required' => false,
                'example' => 'Uma mensagem aqui para o lead.',
            ],
            'notes' => [
                'description' => __('Leads.notes_description'),
                'required' => false,
                'example' => 'Uma nota aqui para o lead.',
            ],
        ];
    }
}

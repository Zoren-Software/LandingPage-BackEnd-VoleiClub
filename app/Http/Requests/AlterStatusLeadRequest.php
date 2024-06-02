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
            'tenantId' => [
                'required',
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
            'tenantId.required' => __('Leads.tenant_id_required'),
            'tenantId.string' => __('Leads.tenant_id_string'),
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
            'tenantId' => [
                'description' => __('Leads.tenant_id_description'),
                'required' => true,
                'example' => 'tenant_id',
            ],
        ];
    }
}

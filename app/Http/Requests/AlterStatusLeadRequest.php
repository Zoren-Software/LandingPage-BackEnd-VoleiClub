<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use GuzzleHttp\Client;
use Illuminate\Validation\Rule;

class AlterStatusLeadRequest extends FormRequest
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
                    'spam'
                ]),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'id.integer' => __('Leads.id_integer'),
            'id.exists' => __('Leads.id_exists'),
            'status.required' => __('Leads.status_required'),
            'status.string' => __('Leads.status_string'),
            'status.in' => __('Leads.status_in'),
        ];
    }
}

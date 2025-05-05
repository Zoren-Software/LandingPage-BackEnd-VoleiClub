<?php

namespace App\Http\Requests;

use App\Http\Requests\Interfaces\ScribeInterface;
use App\Rules\StatusLeadValidRule;
use Illuminate\Foundation\Http\FormRequest;

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
            'status_id' => [
                'required',
                'integer',
                'exists:leads_status,id',
                new StatusLeadValidRule,
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
            'status_id_required' => __('Leads.status_id_required'),
            'status_id_string' => __('Leads.status_id_string'),
            'status_id_exists' => __('Leads.status_id_exists'),
            'message.string' => __('Leads.message_string'),
            'notes.string' => __('Leads.notes_string'),
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public function bodyParameters(): array
    {
        return [
            'id' => [
                'description' => __('Leads.id_description'),
                'required' => true,
                'example' => 1,
            ],
            'status_id' => [
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

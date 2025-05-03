<?php

namespace App\Http\Requests;

use App\Http\Requests\Interfaces\ScribeInterface;
use Illuminate\Foundation\Http\FormRequest;

class PaginateLeadsInteractionsRequest extends FormRequest implements ScribeInterface
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
                'string',
                'exists:leads,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'id.string' => __('Leads.id_string'),
            'id.exists' => __('Leads.id_exists'),
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
                'value' => '1',
            ],
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Http\Requests\Interfaces\ScribeInterface;
use Illuminate\Foundation\Http\FormRequest;

class PaginateLeadsStatusRequest extends FormRequest implements ScribeInterface
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
            'search' => [
                'string',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'search.string' => __('Leads.name_string'),
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public function bodyParameters(): array
    {
        return [
            'search' => [
                'description' => __('Leads.name_description'),
                'required' => false,
                'value' => 'new',
            ],
        ];
    }
}

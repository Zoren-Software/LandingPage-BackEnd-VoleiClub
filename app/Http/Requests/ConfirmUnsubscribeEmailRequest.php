<?php

namespace App\Http\Requests;

use App\Http\Requests\Interfaces\ScribeInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\URL;

class ConfirmUnsubscribeEmailRequest extends FormRequest implements ScribeInterface
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        //return URL::hasValidSignature($this);
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
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'id.string' => __('Leads.id_string'),
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'id' => [
                'description' => 'Um ID assinado de um lead válido para o qual você deseja cancelar a inscrição.',
                'example' => '2?expires=1745459168&locale=pt-br&signature=8fb432ed6c38f78591549cfafde7d3d772b936d523ed2179f2dd80c3b2bf4db0',
            ],
        ];
    }
}

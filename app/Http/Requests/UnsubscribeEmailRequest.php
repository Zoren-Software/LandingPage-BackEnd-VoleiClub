<?php

namespace App\Http\Requests;

use App\Http\Requests\Interfaces\ScribeInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\URL;

class UnsubscribeEmailRequest extends FormRequest implements ScribeInterface
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
            'email' => [
                'required',
                'email',
                'exists:leads,email',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('Leads.email_required'),
            'email.email' => __('Leads.email_email'),
            'email.exists' => __('Leads.email_not_exists'),
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'email' => [
                'description' => 'Um endereço de e-mail válido para o qual você deseja cancelar a inscrição.',
                'required' => true,
                'value' => 'example@email.com',
            ],
        ];
    }
}

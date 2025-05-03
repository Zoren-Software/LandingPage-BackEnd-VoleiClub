<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'token' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um e-mail válido.',
            'token.required' => 'O campo token é obrigatório.',
            'token.string' => 'O campo token deve ser uma string.',
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public function bodyParameters(): array
    {
        return [
            'email' => [
                'description' => 'E-mail do usuário',
                'example' => 'suporte@multiplier.com.br',
                'required' => true,
            ],
            'token' => [
                'description' => 'Token de autenticação',
                'example' => '1|UASHDUAHUDAHSDUHASUD',
                'required' => true,
            ],
        ];
    }
}

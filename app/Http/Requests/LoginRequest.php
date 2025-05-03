<?php

namespace App\Http\Requests;

use App\Http\Requests\Interfaces\ScribeInterface;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest implements ScribeInterface
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
            'password' => 'required',
            'device_name' => 'required',
            'device_type' => 'required|in:web,mobile',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um e-mail válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'device_name.required' => 'O campo device_name é obrigatório.',
            'device_type.required' => 'O campo device_type é obrigatório, pode ser "web" ou "mobile".',
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
            'password' => [
                'description' => 'Senha do usuário',
                'example' => '1234',
                'required' => true,
            ],
            'device_name' => [
                'description' => 'Nome do dispositivo',
                'example' => 'iPhone 15 Pro Max',
                'required' => true,
            ],
            'device_type' => [
                'description' => 'Tipo do dispositivo, apenas "web" ou "mobile" ' .
                    'são aceitos. Com limite de 1 tipo de dispositivo por usuário.',
                'example' => 'web',
                'required' => true,
            ],
        ];
    }
}

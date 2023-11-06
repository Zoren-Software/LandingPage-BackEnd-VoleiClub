<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use GuzzleHttp\Client;
use Illuminate\Validation\Rule;

class CreateLeadRequest extends FormRequest
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
            'email' => [
                'unique:leads,email',
                'required',
            ],
            'name' => [
                'required',
                'string',
            ],
            'experience_level' => [
                'required',
            ],
            'message' => [
                'string',
                'sometimes',
            ],
            'recaptchaToken' => [
                Rule::requiredIf(env('APP_ENV') !== 'testing'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => __('Leads.email.unique'),
            'email.required' => __('Leads.email.required'),
            'name.required' => __('Leads.name.required'),
            'experience_level.required' => __('Leads.experience_level.required'),
            'message.string' => __('Leads.message.string'),
            'recaptchaToken.required' => __('Leads.recaptchaToken.required'),
            'recaptchaToken.string' => __('Leads.recaptchaToken.string'),
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            // if($this->recaptchaToken !== 'testing' && env('APP_ENV') !== 'testing') {
            //     if (!$this->validateRecaptcha($this->recaptchaToken, )) {
            //         $validator->errors()->add('recaptchaToken', 'There was an error with the CAPTCHA. Please try again.');
            //     }
            // }
        });
    }

    protected function validateRecaptcha($token)
    {
        $form = [
            'form_params' => [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $token
            ]
        ];

        $client = new Client();
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify', $form);

        $body = json_decode((string) $response->getBody());

        return $body->success;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}

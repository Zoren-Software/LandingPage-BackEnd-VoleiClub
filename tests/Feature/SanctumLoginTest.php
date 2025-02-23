<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SanctumLoginTest extends TestCase
{
    protected $login = false;

    /**
     * @test
     *
     * @group sanctum
     *
     * @dataProvider loginSuccessProvider
     * @dataProvider loginErrorProvider
     */
    public function login(array $data, int $statusExpected, ?string $typeError): void
    {
        if ($data['device_type']) {
            $data['device_type'] = 'web';
        } else {
            unset($data['device_type']);
        }

        if ($data['device_name']) {
            $data['device_name'] = 'device_name';
        } else {
            unset($data['device_name']);
        }

        if ($data['password']) {
            $data['password'] = 'password';
        } else {
            unset($data['password']);
        }

        if ($data['email']) {
            $user = \App\Models\User::factory()->create();
            $data['email'] = $user->email;
        } else {
            unset($data['email']);
        }

        $response = $this->rest()->postJson('api/login', $data);

        if ($statusExpected == 422) {
            $response->assertJsonValidationErrors([$typeError]);
        }

        $response->assertStatus($statusExpected);

    }

    public static function loginErrorProvider(): array
    {
        return [
            'login, logging not send email, error' => [
                'data' => [
                    'email' => false,
                    'password' => true,
                    'device_name' => true,
                    'device_type' => true,
                ],
                'statusExpected' => 422,
                'typeError' => 'email',
            ],
            'login, logging not send password, error' => [
                'data' => [
                    'email' => true,
                    'password' => false,
                    'device_name' => true,
                    'device_type' => true,
                ],
                'statusExpected' => 422,
                'typeError' => 'password',
            ],
            'login, logging not send device name, error' => [
                'data' => [
                    'email' => true,
                    'password' => true,
                    'device_name' => false,
                    'device_type' => true,
                ],
                'statusExpected' => 422,
                'typeError' => 'device_name',
            ],
            'login, logging not send device type, error' => [
                'data' => [
                    'email' => true,
                    'password' => true,
                    'device_name' => false,
                    'device_type' => false,
                ],
                'statusExpected' => 422,
                'typeError' => 'device_type',
            ],
        ];
    }

    public static function loginSuccessProvider(): array
    {
        return [
            'login, logging in successfully, success' => [
                'data' => [
                    'email' => true,
                    'password' => true,
                    'device_name' => true,
                    'device_type' => true,
                ],
                'statusExpected' => 200,
                'typeError' => null,
            ],
        ];
    }
}

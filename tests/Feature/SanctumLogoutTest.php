<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SanctumLogoutTest extends TestCase
{
    protected $login = true;

    /**
     * @test
     *
     * @group sanctum
     *
     * @dataProvider logoutSuccessProvider
     * @dataProvider logoutErrorProvider
     */
    public function logout(array $data, int $statusExpected, ?string $typeError): void
    {
        if ($data['email']) {
            $data['email'] = \App\Models\User::factory()->create()->email;
        }

        if ($data['token']) {
            $data['token'] = $this->token;
        } else {
            unset($data['token']);
        }

        $response = $this->rest()->post('api/logout', $data);

        if ($statusExpected == 422) {
            $response->assertJsonValidationErrors([$typeError]);
        }

        $response->assertStatus($statusExpected);

    }

    public static function logoutSuccessProvider(): array
    {
        return [
            'logout, logout in successfully, success' => [
                'data' => [
                    'email' => true,
                    'token' => true,
                ],
                'statusExpected' => 200,
                'typeError' => null,
            ],
        ];
    }

    public static function logoutErrorProvider(): array
    {
        return [
            'logout, logout not send email, error' => [
                'data' => [
                    'email' => false,
                    'token' => true,
                ],
                'statusExpected' => 422,
                'typeError' => 'email',
            ],
            'logout, logout not auth token, error' => [
                'data' => [
                    'email' => true,
                    'token' => false,
                ],
                'statusExpected' => 422,
                'typeError' => 'token',
            ],
        ];
    }
}

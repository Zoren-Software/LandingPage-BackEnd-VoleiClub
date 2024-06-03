<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * With value true the test will be logged in
     *
     * @var bool
     */
    protected $login = false;

    /**
     * User to be used in the tests
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * User token to be used in the tests
     *
     * @var string
     */
    protected $token;

    public function setUp(): void
    {
        parent::setUp();

        $this->authorization();
    }

    public function authorization(): void
    {
        if ($this->login) {
            $this->user = \App\Models\User::factory()->create();

            $headers = $this->setHeaders();

            $response = $this->withHeaders($headers)
                ->postJson(
                    '/api/login',
                    [
                        'email' => $this->user->email,
                        'password' => env('USERS_INTERNAL_PASSWORD', 'password'),
                        'device_name' => 'Teste de API',
                        'device_type' => 'web',
                    ]
                );

            $this->token = $response->json('token');
        }

    }

    public function setHeaders(array $headers = []): array
    {
        $headers['accept'] = 'application/json';

        if ($this->token != '' && $this->login) {
            $headers['Authorization'] = "Bearer {$this->token}";
        }

        return $headers;
    }

    public function rest(array $headersAdicionais = [])
    {
        return $this->withHeaders($this->setHeaders($headersAdicionais));
    }
}

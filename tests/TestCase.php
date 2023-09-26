<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setHeaders(array $headers = []): array
    {
        $headers['accept'] = 'application/json';

        return $headers;
    }

    public function rest(array $headersAdicionais = [])
    {
        return $this->withHeaders($this->setHeaders($headersAdicionais));
    }
}

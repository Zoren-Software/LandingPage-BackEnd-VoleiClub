<?php

namespace App\Http\Requests\Interfaces;

interface ScribeInterface
{
    /**
     * @codeCoverageIgnore
     */
    public function bodyParameters(): array;

    public function rules(): array;
}

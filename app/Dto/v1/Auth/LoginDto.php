<?php

namespace App\Dto\v1\Auth;

use App\Http\Requests\v1\Auth\LoginRequest;

readonly class LoginDto
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}

    public static function from(LoginRequest $request): self
    {
        return new self(
            email: $request->email,
            password: $request->password,
        );
    }
}
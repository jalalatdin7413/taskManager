<?php

namespace App\Dto\v1\Auth;

use App\Http\Requests\v1\Auth\RegisterRequest;

readonly class RegisterDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {}

    public static function from(RegisterRequest $request): self
    {
        return new self(
            name: $request->name,
            email: $request->email,
            password: $request->password,
        );
    }
}
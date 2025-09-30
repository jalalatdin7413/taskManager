<?php

namespace App\Actions\v1\Auth;

use App\Dto\v1\Auth\RegisterDto;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class RegisterAction
{
    use ResponseTrait;

    /**
     * Summary of __invoke
     * @param \App\Dto\v1\Auth\RegisterDto $dto
     * @return JsonResponse
     */
    public function __invoke(RegisterDto $dto): JsonResponse
    {
        $data = [
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => bcrypt($dto->password),
        ];

        $user = User::create($data);

        return static::toResponse(
            message: 'Registered successfully',
            data: $user
        );
    }
}
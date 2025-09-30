<?php

namespace App\Actions\v1\Auth;

use App\Dto\v1\Auth\LoginDto;
use App\Exceptions\ApiResponseException;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginAction
{
    use ResponseTrait;

    /**
     * Summary of __invoke
     * @param \App\Dto\v1\Auth\LoginDto $dto
     * @return JsonResponse
     * @throws \App\Exceptions\ApiResponseException
     */
    public function __invoke(LoginDto $dto): JsonResponse
    {
        try {
            $user = User::where('email', $dto->email)->firstOrFail();

            if (! Hash::check($dto->password, $user->password)) {
                throw new ApiResponseException('Kiritilgen login yaki parol duris emes', 401);
            }

            auth()->login($user);

            $accessTokenExpiration = now()->addMinutes(60);
            $refreshTokenExpiration = now()->addDays(30);

            $accessToken = auth()->user()->createToken(
                name: 'access token',
                abilities: ['access-token'],
                expiresAt: $accessTokenExpiration
            );

            $refreshToken = auth()->user()->createToken(
                name: 'refresh token',
                abilities: ['refresh-token'],
                expiresAt: $refreshTokenExpiration
            );

            return static::toResponse(
                message: 'Login successful',
                data: [
                    'access_token' => $accessToken->plainTextToken,
                    'refresh_token' => $refreshToken->plainTextToken,
                    'at_expired_at' => $accessTokenExpiration->format('Y-m-d H:i:s'),
                    'rf_expired_at' => $refreshTokenExpiration->format('Y-m-d H:i:s'),
                ]
            );
        } catch (ModelNotFoundException $e) {
            throw new ApiResponseException('User bazada joq', 404);
        }
    }
}
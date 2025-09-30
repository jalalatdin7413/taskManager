<?php

namespace App\Actions\v1\Auth;

use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class LogoutAction
{
    use ResponseTrait;

    /**
     * Summary of __invoke
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return static::toResponse(
            message: 'Logged out'
        );
    }
}

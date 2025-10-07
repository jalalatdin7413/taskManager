<?php

namespace App\Http\Controllers\Swagger\v1;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class AuthController extends Controller
{
    #[OA\Post(
        path: '/api/v1/auth/register',
        tags: ['Auth'],
        summary: 'Register new user',
    )]
    #[OA\RequestBody(
        required: true,
        description: 'User registration data',
        content: new OA\JsonContent(
            required: ['name', 'email', 'password'],
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'Jony Deep'),
                new OA\Property(property: 'email', type: 'string', format: 'email', example: 'jony@example.com'),
                new OA\Property(property: 'password', type: 'string', format: 'password', example: 'secret123'),
                new OA\Property(property: 'password_confirmation', type: 'string', format: 'password', example: 'secret123')
            ]
        )
    )]
    #[OA\Response(response: 200, description: 'User Registered successfully')]
    #[OA\Response(response: 422, description: 'Validation error')]
    #[OA\Response(response: 500, description: 'Internal server error')]
    public function register()
    {
        //
    }

    #[OA\Post(
        path: '/api/v1/auth/login',
        tags: ["Auth"],
        summary: "Login user",
    )]
    #[OA\RequestBody(
        required: true,
        description: "User login data",
        content: new OA\JsonContent(
            required: ["phone", "password"],
            properties: [
                new OA\Property(property: "email", type: "string", example: "jony@example.com"),
                new OA\Property(property: "password", type: "string", example: "secret123"),
            ]
        )
    )]
    #[OA\Response(response: 200, description: 'User logged in successfully')]
    #[OA\Response(response: 401, description: 'Unauthorized')]
    #[OA\Response(response: 422, description: 'Validation error')]
    #[OA\Response(response: 500, description: 'Internal server error')]
    public function login()
    {
        //
    }

    #[OA\Post(
        path: '/api/v1/auth/logout',
        tags: ["Auth"],
        summary: "Logout user",
        security: [['sanctum' => []]]
    )]
    #[OA\Response(response: 200, description: 'User logged out successfully')]
    #[OA\Response(response: 401, description: 'Unauthenticated')]
    #[OA\Response(response: 500, description: 'Internal server error')]
    public function logout()
    {
        //
    }
}
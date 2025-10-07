<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

use OpenApi\Attributes as OA;

#[
    OA\Info(version: "1.0.0", description: "Task Manager Project Documentation", title: "Task Manager Documentation"),
    OA\PathItem(path: "/v1"),
    OA\Server(url: 'http://localhost:8000/api', description: "local server"),
    OA\SecurityScheme(securityScheme: 'sanctum', type: "apiKey", name: "Authorization", in: "header", description: "Use the Token format: Bearer {your_token}"),
]
class MainController extends Controller
{

}
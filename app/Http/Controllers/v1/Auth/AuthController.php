<?php

namespace App\Http\Controllers\v1\Auth;

use App\Actions\v1\Auth\LoginAction;
use App\Actions\v1\Auth\LogoutAction;
use App\Actions\v1\Auth\RegisterAction;
use App\Dto\v1\Auth\LoginDto;
use App\Dto\v1\Auth\RegisterDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Auth\LoginRequest;
use App\Http\Requests\v1\Auth\RegisterRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{

   /**
    * Summary of register
    * @param \App\Http\Requests\v1\Auth\RegisterRequest $request
    * @param \App\Actions\v1\Auth\RegisterAction $action
    * @return JsonResponse
    */
   public function register(RegisterRequest $request, RegisterAction $action): JsonResponse
    {
        return $action(RegisterDto::from($request));
    }

    /**
     * Summary of login
     * @param \App\Http\Requests\v1\Auth\LoginRequest $request
     * @param \App\Actions\v1\Auth\LoginAction $action
     * @return JsonResponse
     */
    public function login(LoginRequest $request, LoginAction $action): JsonResponse
    {
        return $action(LoginDto::from($request));
    }

    /**
     * Summary of logout
     * @param \App\Actions\v1\Auth\LogoutAction $action
     * @return JsonResponse
     */
    public function logout(LogoutAction $action): JsonResponse
    {
        return $action();
    }
}
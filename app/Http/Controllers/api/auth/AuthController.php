<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\user\UserAddRequest;
use App\Http\Requests\api\user\UserChangePassRequest;
use App\Http\Requests\api\user\UserLoginRequest;
use App\Models\User;
use App\Services\auth\AuthService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private AuthService $service;
    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }


    public function signup(UserAddRequest $request): JsonResponse
    {
        return $this->service->signupUser($request);
    }


    public function login(UserLoginRequest $request): JsonResponse
    {
        return $this->service->loginUser($request);
    }


    public function changePassUser(UserChangePassRequest $request): JsonResponse
    {
        return $this->service->changePassUser($request);
    }

    public function logout(): JsonResponse
    {
        return $this->service->logoutUser();
    }

}

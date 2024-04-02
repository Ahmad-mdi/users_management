<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\user\UserAddRequest;
use App\Http\Requests\api\user\UserLoginRequest;
use App\Models\user;
use App\Services\auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthService $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }
    public function signup(UserAddRequest $request)
    {
        $add = $this->service->signupUser($request);
        return $this->successResponse(201, $add, $this->getMessageEnvFile('ADD_DATA'));
    }
    public function login(UserLoginRequest $request)
    {
        return $this->service->loginUser($request);
    }

}

<?php

namespace App\Repositories\auth;

use App\Http\Requests\api\user\UserLoginRequest;
use Illuminate\Http\Request;

interface AuthRepository
{
    public function signupUser(Request $request);
    public function loginUser(UserLoginRequest $request);
}

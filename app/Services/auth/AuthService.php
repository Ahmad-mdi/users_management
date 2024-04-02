<?php

namespace App\Services\auth;

use App\Models\User;
use App\Traits\ApiResponse;
use App\Repositories\auth\AuthRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthRepository
{
    use ApiResponse;

    public function signupUser(Request $request): Model|Builder
    {
        return User::query()->create([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'username' => $request->get('username'),
            'nationalCode' => $request->get('nationalCode'),
            'status' => $request->get('status'),
            'password' => bcrypt($request->get('password')),
        ]);
    }

    public function loginUser(Request $request): JsonResponse
    {
        $user = User::query()->where('username',$request->username)->firstOrFail();
        if (!Hash::check($request->password,$user->password)) {
            return $this->errorResponse(422,null,env('invalid_pass'));
        }
        $token = $user->createToken($user->username)->plainTextToken;
        return $this->successResponse(200,[
            'user' => $user,
            'token' => $token,
        ],env('user_login'));
    }
}

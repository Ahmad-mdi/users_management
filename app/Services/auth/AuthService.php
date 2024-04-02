<?php

namespace App\Services\auth;

use App\Models\User;
use App\Traits\ApiResponse;
use App\Repositories\auth\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthRepository
{
    use ApiResponse;
    public function signupUser(Request $request){
        return User::query()->create([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'username' => $request->get('username'),
            'nationalCode' => $request->get('nationalCode'),
            'status' => $request->get('status'),
            'password' => bcrypt($request->get('password')),
        ]);
    }

    public function loginUser(Request $request)
    {
        $user = User::query()->where('username',$request->username)->firstOrFail();
        if (!Hash::check($request->password,$user->password)) {
            return $this->errorResponse(422,null,'password is incorrect');
        }
        $token = $user->createToken($user->username)->plainTextToken;
        return $this->successResponse(200,[
            'user' => $user,
            'token' => $token,
        ],'user logIn');
    }
}

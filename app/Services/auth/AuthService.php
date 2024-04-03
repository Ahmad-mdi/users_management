<?php

namespace App\Services\auth;

use App\Models\User;
use App\Traits\ApiResponse;
use App\Repositories\auth\AuthRepository;
use Carbon\Carbon;
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
        $user = User::query()->where('username', $request->username)->first();

        if ($user->try_count >= 3 && $user->lock_time > now())
            return $this->errorResponse(429, null, env('REQUEST_MANY_LOGIN'));


        if (auth()->attempt($request->only('username', 'password'))) {
            // After successful login, reset try_count and lock_time = null/0
            $user->update(['try_count' => 0, 'lock_time' => null]);
            return $this->successResponse(200, $user, env('USER_LOGIN'));
        } else {
            $user->increment('try_count');

            if ($user->try_count >= 3) {
                $user->lock_time = Carbon::now()->addMinutes(10);
                $user->save();
                return $this->errorResponse(429, null, env('USER_LOCKED'));
            }

            return $this->errorResponse(401, null, env('INVALID_USER'));
        }
    }

}

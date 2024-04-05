<?php

namespace App\Services\auth;

use App\Http\Resources\api\user\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use App\Repositories\auth\AuthRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\isEmpty;

class AuthService implements AuthRepository
{
    use ApiResponse;


    public function signupUser(Request $request): JsonResponse
    {
        $user = User::query()->create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'username' => $request->input('username'),
            'nationalCode' => $request->input('nationalCode'),
            'status' => $request->input('status'),
            'password' => bcrypt($request->input('password')),
        ]);
        $token = $user->createToken($user->username, ['*'], Carbon::now()->addDays(7))->plainTextToken;
        Log::info($user.': '.$this->getMessageEnvFile('USER_SIGNUP'));

        return $this->successResponse(201, [
            'userInfo' => new UserResource($user),
            'token' => $token,
        ], $this->getMessageEnvFile('ADD_DATA'));
    }


    public function loginUser(Request $request): JsonResponse
    {
        $user = User::query()->where('username', $request->username)->first();
        $userResource = new UserResource($user);

        if ($user->try_count >= 3 && $user->lock_time > now())
            return $this->errorResponse(429, null, $this->getMessageEnvFile('REQUEST_MANY_LOGIN'));

        if (auth()->attempt($request->only('username', 'password'))) {
            $user->update(['try_count' => 0, 'lock_time' => null]);
            $token = $user->createToken($user->username, ['*'], Carbon::now()->addDays(7))->plainTextToken;

            return $this->successResponse(200,
                ['user' => $userResource, 'token' => $token], $this->getMessageEnvFile('USER_LOGIN'));
        } else {
            $user->increment('try_count');
            if ($user->try_count >= 3) {
                $user->lock_time = Carbon::now()->addMinutes(10);
                $user->save();
                return $this->errorResponse(429, null, $this->getMessageEnvFile('USER_LOCKED'));
            }
            return $this->errorResponse(401, null, $this->getMessageEnvFile('INVALID_USER'));
        }
    }


    public function changePassUser(Request $request): JsonResponse
    {
        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return $this->errorResponse(400, null, $this->getMessageEnvFile('CURRENT_PASSWORD'));
        }

        $user->update(['password' => bcrypt($request->new_password)]);

        return $this->successResponse(200, new UserResource($user), $this->getMessageEnvFile('CHANGED_PASSWORD'));
    }


    public function logoutUser(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return $this->successResponse(200, true, $this->getMessageEnvFile('USER_LOGOUT'));
    }
}

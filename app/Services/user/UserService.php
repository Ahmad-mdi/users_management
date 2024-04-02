<?php

namespace App\Services\user;

use App\Http\Resources\api\user\UserResource;
use App\Models\User;
use App\Repositories\user\UserRepository;
use Illuminate\Http\Request;
use function bcrypt;

class UserService implements UserRepository
{
    public function getAll()
    {
        return User::query()->paginate(50);
    }

    public function findByUsername(Request $request){
        $search = $request->get('search');
        $users =  User::query()->where('username', 'like', "%$search%")->paginate(50);
        return UserResource::collection($users);
    }
}

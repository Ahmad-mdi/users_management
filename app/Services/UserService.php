<?php

namespace App\Services;

use App\Http\Resources\api\users\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use http\Env\Response;
use Illuminate\Http\Request;

class UserService implements UserRepository
{
    public function getAll()
    {
        return User::paginate(50);
    }

    public function addUser(Request $request): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
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

    public function findByUsername(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $search = $request->get('search');
        $users =  User::where('username', 'like', "%$search%")->paginate(50);
        return UserResource::collection($users);
    }
}

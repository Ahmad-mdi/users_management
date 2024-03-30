<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserServiceImpl implements UserService
{
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return User::all();
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
}

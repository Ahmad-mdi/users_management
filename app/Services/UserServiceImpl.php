<?php

namespace App\Services;

use App\Models\User;

class UserServiceImpl implements UserService{
   public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return User::all();
    }
}

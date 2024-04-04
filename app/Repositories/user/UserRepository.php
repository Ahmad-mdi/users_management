<?php

namespace App\Repositories\user;

use App\Models\User;
use Illuminate\Http\Request;

interface UserRepository
{
    public function getAll();
    public function findByUsername(Request $request);
    public function updateUser(Request $request,User $user);
    public function removeUser(User $user);
}

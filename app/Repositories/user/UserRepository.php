<?php

namespace App\Repositories\user;

use Illuminate\Http\Request;

interface UserRepository
{
    public function getAll();

    public function findByUsername(Request $request);
}

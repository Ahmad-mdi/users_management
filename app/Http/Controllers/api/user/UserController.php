<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\user\UserAddRequest;
use App\Http\Requests\api\user\UserEditRequest;
use App\Models\User;
use App\Services\user\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }


    public function index()
    {
       return $this->service->getAll();
    }


    public function findByUsername(Request $request)
    {
        return $this->service->findByUsername($request);
    }


    public function update(UserEditRequest $request, User $user)
    {
        return $this->service->updateUser($request,$user);
    }


    public function destroy(User $user)
    {
        return $this->service->removeUser($user);
    }
}

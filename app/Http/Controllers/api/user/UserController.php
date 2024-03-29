<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\users\UserAddRequest;
use App\Models\User;
use App\Services\UserServiceImpl;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserServiceImpl $service;

    public function __construct(UserServiceImpl $service)
    {
        $this->service = $service;
    }


    public function index(): \Illuminate\Http\JsonResponse
    {
        $data = $this->service->getAll();
        return $this->successResponse(200,$data, env('READ_DATA'));
    }

    public function store(UserAddRequest $request): \Illuminate\Http\JsonResponse
    {
        $add = $this->service->addUser($request);
        return $this->successResponse(201,$add,env('ADD_DATA'));
    }

    public function show(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}

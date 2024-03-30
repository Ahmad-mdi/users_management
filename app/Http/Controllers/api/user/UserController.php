<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\users\UserAddRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }


    public function index(): \Illuminate\Http\JsonResponse
    {
        $data = $this->service->getAll();
        return $this->successResponse(200,
            $this->paginationUsers($data),
            $this->getMessageEnvFile('FIND_DATA'));
    }

    public function store(UserAddRequest $request): \Illuminate\Http\JsonResponse
    {
        $add = $this->service->addUser($request);
        return $this->successResponse(201, $add, $this->getMessageEnvFile('ADD_DATA'));
    }

    public function findByUsername(Request $request): \Illuminate\Http\JsonResponse
    {
        $listOfSearch = $this->service->findByUsername($request);
        return $this->successResponse(201,
            $this->paginationUsers($listOfSearch),
            $this->getMessageEnvFile('FIND_DATA'));
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

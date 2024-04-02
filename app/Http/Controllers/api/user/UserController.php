<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\user\UserAddRequest;
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
        $data = $this->service->getAll();
        return $this->successResponse(200,
            $this->paginationUsers($data),
            $this->getMessageEnvFile('FIND_DATA'));
    }

    public function store(Request $request)
    {
       //
    }

    public function findByUsername(Request $request)
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

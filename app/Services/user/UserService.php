<?php

namespace App\Services\user;

use App\Http\Resources\api\user\UserResource;
use App\Models\User;
use App\Repositories\user\UserRepository;
use App\Traits\ApiResponse;
use App\Traits\User\UserTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserService implements UserRepository
{
    use UserTrait;
    use ApiResponse;


    public function getAll(): JsonResponse
    {
        $data = User::query()->paginate(50);

        return $this->successResponse(200,
            $this->paginationUsers($data),
            $this->getMessageEnvFile('FIND_DATA'));
    }

    public function findByUsername(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $users = User::query()->where('username', 'like', "%$search%")->paginate(50);
        $listOfSearch = UserResource::collection($users);

        return $this->successResponse(201,
            $this->paginationUsers($listOfSearch),
            $this->getMessageEnvFile('FIND_DATA'));
    }

    public function updateUser(Request $request,User $user): JsonResponse
    {
         $user->update($request->all());
        return $this->successResponse(201,true,$this->getMessageEnvFile('USER_UPDATED'));
    }

    public function removeUser(User $user): JsonResponse
    {
        $user->delete();
        return $this->successResponse(200,true,$this->getMessageEnvFile('USER_REMOVED'));
    }
}

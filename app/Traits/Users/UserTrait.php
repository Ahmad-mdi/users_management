<?php

namespace App\Traits\Users;

use App\Http\Resources\api\users\UserResource;

trait UserTrait
{
    protected function paginationUsers($data): array
    {
        return array([
            'data' => UserResource::collection($data),
            'pagination' => [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'next_page_url' => $data->nextPageUrl(),
                'prev_page_url' => $data->previousPageUrl(),
            ],
        ]);
    }
}

<?php

namespace App\Http\Resources\api\user;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'username' => $this->username,
            'fullName' => $this->firstname . ' ' . $this->lastname,
            'nationalCode'=> $this->nationalCode,
            'status' => $this->status,
        ];
    }
}

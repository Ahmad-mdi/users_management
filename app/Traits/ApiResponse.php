<?php
namespace App\Traits;

use App\Http\Resources\api\user\UserResource;
use App\Models\User;
use JetBrains\PhpStorm\Pure;

trait ApiResponse{

    protected function getMessageEnvFile($key){
        return env($key);
    }

    protected function successResponse($code,$data,$message=null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data,
        ],$code);
    }

    protected function errorResponse($code,$data,$message=null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'Failed',
            'message' => $message,
            'data' => null,
        ],$code);
    }

}

<?php

use App\Http\Controllers\api\auth\AuthController;
use App\Http\Controllers\api\user\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/users','middleware' => 'auth:sanctum'], function () {
    Route::get('/',[UserController::class,'index']);
    Route::get('/search',[UserController::class,'findByUsername']);
    Route::post('/signup',[AuthController::class,'signup']);
    Route::post('/login',[AuthController::class,'login']);
    Route::put('/changePass',[AuthController::class,'changePassUser']);
    Route::put('/{user}',[UserController::class,'update']);
    Route::delete('/{user}',[UserController::class,'destroy']);
});


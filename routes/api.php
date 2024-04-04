<?php

use App\Http\Controllers\api\auth\AuthController;
use App\Http\Controllers\api\user\UserController;
use Illuminate\Support\Facades\Route;


//routing for users****

Route::group(['prefix' => '/users','middleware' => 'auth:sanctum'], function () {
    Route::get('/',[UserController::class,'index']);
    Route::get('/search',[UserController::class,'findByUsername']);
    Route::post('/signup',[AuthController::class,'signup']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::put('/changePass',[AuthController::class,'changePassUser']);
    Route::put('/{user}',[UserController::class,'update']);
    Route::delete('/{user}',[UserController::class,'destroy']);
});

Route::group(['middleware'=>'guest:sanctum'],function (){
    Route::post('/users/login',[AuthController::class,'login']);
});

//end routing users****


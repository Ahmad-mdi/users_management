<?php

use App\Http\Controllers\api\auth\AuthController;
use App\Http\Controllers\api\user\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/users'], function () {
    Route::apiResource('/',UserController::class);
    Route::get('/search',[UserController::class,'findByUsername']);
    Route::post('/signup',[AuthController::class,'signup']);
    Route::post('/login',[AuthController::class,'login']);
});

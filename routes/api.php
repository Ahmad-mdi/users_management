<?php

use App\Http\Controllers\api\user\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/user',UserController::class);

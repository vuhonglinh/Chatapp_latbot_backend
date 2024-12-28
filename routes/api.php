<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->group(function(){
    Route::get('user',[ChatController::class,'getUsers']);
});

//Google
Route::get('/auth/google', [AuthController::class, 'loginGoogle']);
Route::post('/auth/google/callback', [AuthController::class, 'callbackGoogle']);

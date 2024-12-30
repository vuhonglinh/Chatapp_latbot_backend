<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('profile', [AuthController::class, 'profile']);

    Route::get('user', [ChatController::class, 'getUsers']);
    Route::get('message/{slug}', [ChatController::class, 'getRoomMessages']);
    Route::post('send/{slug}', [ChatController::class, 'send']);


});

//Google
Route::get('/auth/google', [AuthController::class, 'loginGoogle']);
Route::post('/auth/google/callback', [AuthController::class, 'callbackGoogle']);
Route::post('/logout', [AuthController::class, 'logout']);

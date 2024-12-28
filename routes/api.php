<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Google
Route::get('/auth/google', [AuthController::class, 'loginGoogle']);
Route::post('/auth/google/callback', [AuthController::class, 'callbackGoogle']);

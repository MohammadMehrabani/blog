<?php

use Illuminate\Support\Facades\Route;
use Src\User\Http\Controllers\AuthController;
use Src\User\Http\Controllers\ListUsersController;
use Src\User\Http\Controllers\UpdateUserAvatarController;

Route::post('users/update-avatar', UpdateUserAvatarController::class)->middleware('auth:api');
Route::get('users', ListUsersController::class)->middleware('auth:api');

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me'])->middleware('auth:api');
});

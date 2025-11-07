<?php

use Illuminate\Support\Facades\Route;
use Src\Post\Http\Controllers\ListPostsController;
use Src\Post\Http\Controllers\ReadPostController;

Route::prefix('posts')->middleware(['auth:api'])->group(function () {
    Route::get('/', ListPostsController::class);
    Route::get('/{id}', ReadPostController::class);
});

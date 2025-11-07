<?php

use Illuminate\Support\Facades\Route;
use Src\Post\Http\Controllers\ListPostsController;
use Src\Post\Http\Controllers\ReadPostController;

Route::prefix('posts')->middleware(['auth:api'])->as('posts.')->group(function () {
    Route::get('/', ListPostsController::class)->name('list');
    Route::get('/{id}', ReadPostController::class)->name('read');
});

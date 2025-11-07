<?php

namespace Src\Post;

use Illuminate\Support\Facades\Route;
use Src\SharedKernel\Providers\BaseServiceProvider;
use Src\Post\Contracts\PostRepositoryContract;
use Src\Post\Repositories\EloquentPostRepository;

class PostServiceProvider extends BaseServiceProvider
{
    protected array $repositories = [
        PostRepositoryContract::class => EloquentPostRepository::class,
    ];

    protected function loadRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(__DIR__.'/routes/api.php');
    }
}

<?php

namespace Src\User;

use Illuminate\Support\Facades\Route;
use Src\SharedKernel\Providers\BaseServiceProvider;
use Src\User\Contracts\UserRepositoryContract;
use Src\User\Repositories\EloquentUserRepository;

class UserServiceProvider extends BaseServiceProvider
{
    protected array $repositories = [
        UserRepositoryContract::class => EloquentUserRepository::class,
    ];

    protected function loadRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(__DIR__.'/routes/api.php');
    }
}

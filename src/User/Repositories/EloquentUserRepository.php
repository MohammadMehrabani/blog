<?php

namespace Src\User\Repositories;

use Src\User\Contracts\UserRepositoryContract;
use Src\SharedKernel\Repositories\EloquentBaseRepository;
use Src\User\Models\User;

class EloquentUserRepository extends EloquentBaseRepository implements UserRepositoryContract
{
    public function model(): string
    {
        return User::class;
    }
}

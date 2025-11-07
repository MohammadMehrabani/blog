<?php

namespace Src\Post\Repositories;

use Src\Post\Contracts\PostRepositoryContract;
use Src\SharedKernel\Repositories\EloquentBaseRepository;
use Src\Post\Models\Post;

class EloquentPostRepository extends EloquentBaseRepository implements PostRepositoryContract
{
    public function model(): string
    {
        return Post::class;
    }
}

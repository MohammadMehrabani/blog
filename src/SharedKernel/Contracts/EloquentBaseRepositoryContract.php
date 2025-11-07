<?php

namespace Src\SharedKernel\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface EloquentBaseRepositoryContract
{
    public function create(array $attributes): Model;

    public function update(int|string $id, array $attributes): Model;

    public function count(array $where): int;

    public function get(
        array $where = [],
        array $relations = [],
        bool $paginate = false,
        int $perPage = 15,
        string $order = 'id',
        string $sort = 'desc'
    ): Collection|LengthAwarePaginator;

    public function findOrFail(array $where, array $relations = []): Model;
}

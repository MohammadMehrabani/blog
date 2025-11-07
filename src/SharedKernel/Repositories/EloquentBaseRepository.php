<?php

namespace Src\SharedKernel\Repositories;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Src\SharedKernel\Contracts\EloquentBaseRepositoryContract;

abstract class EloquentBaseRepository implements EloquentBaseRepositoryContract
{
    protected Application $app;

    protected Model $model;

    /**
     * @throws \Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract public function model(): string;

    /**
     * @throws BindingResolutionException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    public function create(array $attributes): Model
    {
        return $this->model::query()->create($attributes);
    }

    public function update(int|string $id, array $attributes): Model
    {
        $model = $this->model::query()->find($id);

        return tap($model)->update($attributes);
    }

    public function count(array $where): int
    {
        return $this->model::query()->where($where)->count();
    }

    public function get(
        array $where = [],
        array $relations = [],
        bool $paginate = false,
        int $perPage = 15,
        string $order = 'id',
        string $sort = 'desc'
    ): Collection|LengthAwarePaginator
    {
        $query = $this->model::query()->with($relations)->where($where);

        $query->orderBy($order, $sort);

        if ($paginate) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    public function findOrFail(array $where, array $relations = []): Model
    {
        $model = $this->model::query()->with($relations)->where($where)->first();

        if (is_null($model)) {
            throw (new ModelNotFoundException)->setModel(
                get_class($this->model)
            );
        }

        return $model;
    }
}

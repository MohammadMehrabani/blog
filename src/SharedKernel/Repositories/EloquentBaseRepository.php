<?php

namespace Src\SharedKernel\Repositories;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as Application;
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
}

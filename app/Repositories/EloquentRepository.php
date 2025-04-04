<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository
{
    private Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function findBy(string $column, mixed $value): ?Model
    {
        return $this->model::where($column, $value)->first();
    }
}

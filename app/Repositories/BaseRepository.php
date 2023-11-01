<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    abstract protected function applyCommonQueries(Builder $query): Builder;

    public function getFilteredModelCount(): int
    {
        $query = $this->model::query();
        $query = $this->applyCommonQueries($query);
        return $query->count();
    }

    public function applyPagination(Builder $query, int $pageIndex): Builder
    {
        return $query->limit(10)
            ->orderBy('id')
            ->offset(($pageIndex - 1) * 10);
    }
}

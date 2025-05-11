<?php

namespace App\Helpers;

use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

trait QueryableTrait
{
    public function query($request = null): QueryBuilder
    {
        $builder = QueryBuilder::for($this->model->newQuery(), $request);

        if (!empty($this->allowedFilters)) {
            $builder->allowedFilters($this->allowedFilters);
        }

        if (!empty($this->allowedSorts)) {
            $builder->allowedSorts($this->allowedSorts);
        }

        if (!empty($this->allowedIncludes)) {
            $builder->allowedIncludes($this->allowedIncludes);
        }

        if (!empty($this->allowedFilterScopes)) {
            $builder->allowedFilters(array_map(function ($scope) {
                return AllowedFilter::scope($scope);
            }, $this->allowedFilterScopes));
        }

        return $builder;
    }

    public function paginate($paginatePerBage = 9)
    {
        return $this->query()->paginate($paginatePerBage);
    }
}

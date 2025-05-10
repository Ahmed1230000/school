<?php

namespace App\Contracts;

use Spatie\QueryBuilder\QueryBuilder;

interface QueryableRepositoryInterface
{
    public function query($query): QueryBuilder;
}

<?php

namespace App\Repositories;

use App\Contracts\QueryableRepositoryInterface;
use App\Contracts\RepositoryInterface;
use App\Helpers\QueryableTrait;
use App\Models\User;

class UserRepository extends BaseRepository implements RepositoryInterface, QueryableRepositoryInterface
{
    use QueryableTrait;

    /**
     * The model instance.
     *
     * @var \App\Models\User
     */
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param  \App\Models\User  $model
     * @return void
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}

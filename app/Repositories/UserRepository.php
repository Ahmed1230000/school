<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
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
        $this->model = $model;
    }
}

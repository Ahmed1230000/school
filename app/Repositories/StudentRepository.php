<?php


namespace App\Repositories;

use App\Contracts\QueryableRepositoryInterface;
use App\Contracts\RepositoryInterface;
use App\Helpers\QueryableTrait;
use App\Models\Student;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class StudentRepository extends BaseRepository implements RepositoryInterface, QueryableRepositoryInterface
{
    use QueryableTrait;

    protected $allowedFilters = [];

    protected $allowedSorts = [];

    protected $allowedIncludes = [];

    protected $allowedFilterScopes = [];

    public function __construct(Student $student)
    {
        parent::__construct($student);
    }
}

<?php

namespace App\Repositories;

use App\Contracts\QueryableRepositoryInterface;
use App\Contracts\RepositoryInterface;
use App\Helpers\QueryableTrait;
use App\Models\ClassRoom;

class ClassRoomRepository extends BaseRepository implements RepositoryInterface, QueryableRepositoryInterface
{
    use QueryableTrait;

    public function __construct(ClassRoom $model)
    {
        parent::__construct($model);
    }

    public function create(array $data): ClassRoom
    {
        $classRoom = $this->model->create($data);

        if (isset($data['teachers']) && is_array($data['teachers'])) {
            $teachers = array_filter($data['teachers'], 'is_numeric');
            $classRoom->teachers()->attach($teachers);
        }
        if (isset($data['students']) && is_array($data['students'])) {
            $students = array_filter($data['students'], 'is_numeric');
            $classRoom->students()->attach($students);
        }
        return $classRoom;
    }

    public function update(array $data, $id): ClassRoom
{
    $classRoom = $this->find($id);
    if ($classRoom) {
        $classRoom->update($data);

        $teachers = isset($data['teachers']) && is_array($data['teachers']) ? array_filter($data['teachers'], 'is_numeric') : [];
        $classRoom->teachers()->sync($teachers);

        $students = isset($data['teachers']) && is_array($data['students']) ? array_filter($data['students'], 'is_numeric') : [];
        $classRoom->students()->sync($students);
    }
    return $classRoom;
}
}

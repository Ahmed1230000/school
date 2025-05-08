<?php

namespace App\Repositories;

use App\Models\ClassRoom;

class ClassRoomRepository extends BaseRepository
{

    public function __construct(ClassRoom $model)
    {
        parent::__construct($model);
    }

    public function create(array $data): ClassRoom
    {
        $classRoom = $this->model->create($data);

        if (isset($data['teachers']) && is_array($data['teachers'])) {
            $classRoom->teachers()->attach($data['teachers']);
        }
        if (isset($data['students']) && is_array($data['students'])) {
            $classRoom->students()->attach($data['students']);
        }
        return $classRoom;
    }


    public function update(array $data, $id): ClassRoom
    {
        $classRoom = $this->find($id);
        if ($classRoom) {
            $classRoom->update($data);

            if (array_key_exists('teachers', $data)) {
                $teachers = $data['teachers'] ?? [];
                $teachers = array_filter($teachers, 'is_numeric');
                $classRoom->teachers()->sync($teachers);
            }

            if (array_key_exists('students', $data)) {
                $students = $data['students'] ?? [];
                $students = array_filter($students, 'is_numeric');
                $classRoom->students()->sync($students);
            }
        }
        return $classRoom;
    }
}

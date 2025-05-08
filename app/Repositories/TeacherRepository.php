<?php

namespace App\Repositories;

use App\Enum\StatusType;
use App\Models\Teacher;
use Illuminate\Support\Facades\Log;

class TeacherRepository extends BaseRepository
{
    public function __construct(Teacher $teacher)
    {
        parent::__construct($teacher);
    }


    public function create(array $data): Teacher
    {
        $teacher = $this->model->create($data);
        if (isset($data['students']) && is_array($data['students'])) {
            $teacher->students()->attach($data['students']);
        }
        return $teacher;
    }

    public function update(array $data, $id): Teacher
    {
        $teacher = $this->find($id);
        if ($teacher) {
            $teacher->update($data);

            if (array_key_exists('students', $data)) {
                $students = $data['students'] ?? [];
                $students = array_filter($students, 'is_numeric');
                $teacher->students()->sync($students);
            }
        }
        return $teacher;
    }
}

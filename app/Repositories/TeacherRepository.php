<?php

namespace App\Repositories;

use App\Contracts\QueryableRepositoryInterface;
use App\Contracts\RepositoryInterface;
use App\Enum\StatusType;
use App\Helpers\QueryableTrait;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TeacherRepository extends BaseRepository implements RepositoryInterface, QueryableRepositoryInterface
{
    use QueryableTrait;

    public function __construct(Teacher $teacher)
    {
        parent::__construct($teacher);
    }

    public function create(array $data): Teacher
    {
        try {
            $teacher = $this->model->create($data);

            if (isset($data['students']) && is_array($data['students'])) {
                $teacher->students()->attach($data['students']);
            }

            if (array_key_exists('materials', $data)) {
                $validMaterials = array_filter($data['materials'] ?? [], fn($material) => is_array($material) && !empty(trim($material['name'] ?? '')));
                $validMaterials = array_values($validMaterials);

                $materialsToCreate = [];
                foreach ($validMaterials as $materialData) {
                    $materialsToCreate[] = [
                        'name'        => $materialData['name'],
                        'description' => $materialData['description'] ?? null,
                        'teacher_id'  => $teacher->id,
                        'created_by'  => Auth::id(),
                    ];
                }
                $teacher->materials()->createMany($materialsToCreate);
            }

            return $teacher;
        } catch (Exception $e) {
            Log::error('Error in TeacherRepository@create: ', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $data,
            ]);
            throw new Exception('Failed to create teacher');
        }
    }

    public function update(array $data, $id): Teacher
    {
        try {
            $teacher = $this->find($id);
            if (!$teacher) {
                throw new Exception("Teacher not found with ID: $id");
            }

            $teacher->update($data);

            if (array_key_exists('students', $data)) {
                $students = $data['students'] ?? [];
                $students = array_filter($students, 'is_numeric');
                $teacher->students()->sync($students);
            }

            if (array_key_exists('materials', $data)) {
                $materials = array_filter($data['materials'] ?? [], fn($material) => is_array($material) && !empty(trim($material['name'] ?? '')));
                $materials = array_values($materials);

                $materialsCreate = [];
                $materialsUpdate = [];
                foreach ($materials as $material) {
                    if (isset($material['id']) && is_numeric($material['id'])) {
                        $materialsUpdate[] = $material;
                    } else {
                        $materialsCreate[] = $material;
                    }
                }

                $existingMaterialIds = $teacher->materials()->pluck('id')->toArray();
                $requestMaterialIds = array_filter(array_column($materialsUpdate, 'id'), 'is_numeric');
                $materialsToDelete = array_diff($existingMaterialIds, $requestMaterialIds);
                if (!empty($materialsToDelete)) {
                    $teacher->materials()->whereIn('id', $materialsToDelete)->delete();
                }

                foreach ($materialsUpdate as $materialUpdate) {
                    $material = $teacher->materials()->find($materialUpdate['id']);
                    if ($material) {
                        $material->update([
                            'name' => $materialUpdate['name'],
                            'description' => $materialUpdate['description'] ?? null,
                            'created_by' => Auth::id() ?? null
                        ]);
                    }
                }

                if (!empty($materialsCreate)) {
                    foreach ($materialsCreate as $materialCreate) {
                        $teacher->materials()->create([
                            'name' => $materialCreate['name'],
                            'description' => $materialCreate['description'] ?? null,
                            'created_by' => Auth::id(),
                        ]);
                    }
                }
            }

            return $teacher;
        } catch (Exception $e) {
            Log::error('Error in TeacherRepository@update: ' . $e->getMessage());
            throw new Exception('Failed to update teacher');
        }
    }
}

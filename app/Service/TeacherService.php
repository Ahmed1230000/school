<?php


namespace App\Service;

use App\Contracts\CustomeMessageInterface;
use App\Contracts\LogErrorInterface;
use App\Models\Teacher;
use App\Repositories\TeacherRepository;

class TeacherService
{
    protected $teacherRepository;
    protected $logError;
    protected $message;

    public function __construct(
        TeacherRepository $teacherRepository,
        LogErrorInterface $logError,
        CustomeMessageInterface $customMessage
    ) {
        $this->teacherRepository = $teacherRepository;
        $this->logError = $logError;
        $this->message = $customMessage;
    }

    public function getALl()
    {
        try {
            return $this->teacherRepository->paginate();
        } catch (\Exception $e) {
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to fetch teachers!');
            throw $e;
        }
    }

    public function getById($id)
    {
        try {
            return $this->teacherRepository->find(
                $id,
                'students:full_name,grade,phone',
                'classrooms:name,code,floor,type'
            );
        } catch (\Exception $e) {
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to fetch teacher!');
            throw $e;
        }
    }
    public function create(array $data)
    {
        try {
            return $this->teacherRepository->create($data);
        } catch (\Exception $e) {
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to create teacher!');
            throw $e;
        }
    }

    public function update(array $data, $id)
    {
        try {
            return $this->teacherRepository->update($data,  $id);
        } catch (\Exception $e) {
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to update teacher!');
            throw $e;
        }
    }
    public function delete($id)
    {
        try {
            return $this->teacherRepository->delete($id);
        } catch (\Exception $e) {
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to delete teacher!');
            throw $e;
        }
    }
}

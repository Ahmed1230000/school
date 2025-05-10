<?php

namespace App\Service;

use App\Contracts\CustomeMessageInterface;
use App\Contracts\LogErrorInterface;
use App\Repositories\StudentRepository;

class StudentService
{

    protected $studentRepository;
    protected $logError;
    protected $message;

    public function __construct(
        StudentRepository $studentRepository,
        LogErrorInterface $logError,
        CustomeMessageInterface $customMessage
    ) {
        $this->studentRepository = $studentRepository;
        $this->logError = $logError;
        $this->message = $customMessage;
    }

    public function getAll()
    {
        try {
            return $this->studentRepository->paginate();
        } catch (\Exception $e) {
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to fetch students!');
            throw $e;
        }
    }

    public function getById($id)
    {
        try {
            return $this->studentRepository->find(
                $id,
                'teachers:full_name,subject,phone',
                'classrooms:name,code,floor,type'
            );
        } catch (\Exception $e) {
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to fetch student!');
            throw $e;
        }
    }
    public function create(array $data)
    {
        try {
            return $this->studentRepository->create($data);
        } catch (\Exception $e) {
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to create student!');
            throw $e;
        }
    }
    public function update(array $data, $id)
    {
        try {
            return $this->studentRepository->update($data,  $id);
        } catch (\Exception $e) {
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to update student!');
            throw $e;
        }
    }
    public function delete($id)
    {
        try {
            return $this->studentRepository->delete($id);
        } catch (\Exception $e) {
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to delete student!');
            throw $e;
        }
    }
}

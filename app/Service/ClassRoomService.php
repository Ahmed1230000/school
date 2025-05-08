<?php

namespace App\Service;

use App\Contracts\CustomeMessageInterface;
use App\Contracts\LogErrorInterface;
use App\Repositories\ClassRoomRepository;

class ClassRoomService
{

    protected $classRoomRepository;
    protected $logError;
    protected $message;

    public function __construct(
        ClassRoomRepository $classRoomRepository,
        LogErrorInterface $logError,
        CustomeMessageInterface $customMessage
    ) {
        $this->classRoomRepository = $classRoomRepository;
        $this->logError = $logError;
        $this->message = $customMessage;
    }

    public function getAll()
    {
        try {
            return $this->classRoomRepository->all();
        } catch (\Exception $e) {
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to fetch students!');
            throw $e;
        }
    }

    public function getById($id)
    {
        try {
            return $this->classRoomRepository->find($id);
        } catch (\Exception $e) {
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to fetch student!');
            throw $e;
        }
    }

    public function create(array $data)
    {
        try {
            return $this->classRoomRepository->create($data);
        } catch (\Exception $e) {
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to create student!');
            throw $e;
        }
    }
    public function update(array $data, $id)
    {
        try {
            return $this->classRoomRepository->update($data,  $id);
        } catch (\Exception $e) {
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to update student!');
            throw $e;
        }
    }

    public function delete($id)
    {
        try {
            return $this->classRoomRepository->delete($id);
        } catch (\Exception $e) {
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to delete student!');
            throw $e;
        }
    }
}

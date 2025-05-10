<?php

namespace App\Service;

use App\Contracts\CustomeMessageInterface; // Contract for handling custom messages (success/error)
use App\Contracts\LogErrorInterface;       // Contract for logging errors
use App\Contracts\RepositoryInterface;     // The repository interface to handle data access
use App\Repositories\PermissionRepository;

class PermissionService
{
    /**
     * @var RepositoryInterface
     * The repository that handles the data logic for permissions.
     */
    protected $permissionRepository;

    /**
     * @var LogErrorInterface
     * The service that handles logging errors.
     */
    protected $logError;

    /**
     * @var CustomeMessageInterface
     * The service responsible for flashing messages (e.g., success or error messages).
     */
    protected $message;

    /**
     * Constructor to inject the dependencies into the service.
     * 
     * @param PermissionRepository $permissionRepository
     * @param LogErrorInterface $logError
     * @param CustomeMessageInterface $CustomeMessage
     */
    public function __construct(
        PermissionRepository $permissionRepository,
        LogErrorInterface $logError,
        CustomeMessageInterface $CustomeMessage
    ) {
        // Inject the dependencies into the service class
        $this->permissionRepository = $permissionRepository;
        $this->logError = $logError;
        $this->message = $CustomeMessage;
    }

    /**
     * Get all permissions.
     * This method retrieves all permissions from the repository.
     * 
     * @return mixed
     */
    public function getAll()
    {
        try {
            // Retrieve all permissions using the permission repository
            return $this->permissionRepository->paginate();
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            // Flash an error message to the session
            $this->message->flashMessage('error', 'Failed to fetch Permissions!');
        }
    }

    /**
     * Get a permission by its ID.
     * This method retrieves a single permission by its ID from the repository.
     * 
     * @param int $id The ID of the permission to retrieve.
     * @return mixed
     */
    public function getById(int $id)
    {
        try {
            // Retrieve the permission by ID using the permission repository
            return $this->permissionRepository->find($id);
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            // Flash an error message to the session
            $this->message->flashMessage('error', 'Failed to fetch Permission!');
        }
    }

    /**
     * Create a new permission.
     * This method creates a new permission using the permission repository.
     * 
     * @param array $data The data for the new permission.
     * @return mixed
     */
    public function create(array $data)
    {
        try {
            // Create the new permission using the permission repository
            $Permission = $this->permissionRepository->create($data);
            // Flash a success message to the session
            $this->message->flashMessage('success', 'Permission created successfully!');
            return $Permission;
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            // Flash an error message to the session
            $this->message->flashMessage('error', 'Failed to create Permission!');
        }
    }

    /**
     * Update an existing permission.
     * This method updates an existing permission using the permission repository.
     * 
     * @param array $data The data to update the permission.
     * @param int $id The ID of the permission to update.
     * @return mixed
     */
    public function update(array $data, int $id)
    {
        try {
            // Update the permission using the permission repository
            $Permission = $this->permissionRepository->update($data, $id);
            // Flash a success message to the session
            $this->message->flashMessage('success', 'Permission updated successfully.');
            return $Permission;
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            // Flash an error message to the session
            $this->message->flashMessage('error', 'Failed to update Permission!');
        }
    }

    /**
     * Delete a permission.
     * This method deletes an existing permission using the permission repository.
     * 
     * @param int $id The ID of the permission to delete.
     * @return mixed
     */
    public function delete(int $id)
    {
        try {
            // Delete the permission using the permission repository
            $Permission = $this->permissionRepository->delete($id);
            // Flash a success message to the session
            $this->message->flashMessage('success', 'Permission deleted successfully.');
            return $Permission;
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            // Flash an error message to the session
            $this->message->flashMessage('error', 'Failed to delete Permission!');
        }
    }

    /**
     * Assign a permission to a user.
     * This method assigns a permission to a user using the permission repository.
     * 
     * @param array $data The data containing 'user_id' and 'permissions'.
     * @return bool True on success, false on failure.
     */
    public function assignPermissionToUser(array $data)
    {
        try {
            // Assign the permission to the user using the permission repository
            $this->permissionRepository->assignPermission($data);
            // Flash a success message to the session
            $this->message->flashMessage('success', 'Permission assigned to user successfully!');
            return true;
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            // Flash an error message to the session
            $this->message->flashMessage('error', 'Failed to assign Permission to user!');
            return false;
        }
    }

    /**
     * Revoke a permission from a user.
     * This method revokes a permission from a user using the permission repository.
     * 
     * @param array $data The data containing 'user_id' and 'permissions'.
     * @return bool True on success, false on failure.
     */
    public function revokePermissionToUser(array $data)
    {
        try {
            // Revoke the permission from the user using the permission repository
            $this->permissionRepository->revokePermission($data);
            // Flash a success message to the session
            $this->message->flashMessage('success', 'Permission revoked from user successfully!');
            return true;
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            // Flash an error message to the session
            $this->message->flashMessage('error', 'Failed to revoke Permission from user!');
            return false;
        }
    }
}

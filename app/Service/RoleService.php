<?php

namespace App\Service;

use App\Contracts\CustomeMessageInterface;   // Contract for handling custom messages (success/error)
use App\Contracts\LogErrorInterface;         // Contract for logging errors
use App\Repositories\RoleRepository;         // The Role repository to handle data access

class RoleService
{
    /**
     * @var RoleRepository
     * Repository instance for interacting with Role data.
     */
    protected $roleRepository;

    /**
     * @var LogErrorInterface
     * Service for logging errors.
     */
    protected $logError;

    /**
     * @var CustomeMessageInterface
     * Service for flashing custom success/error messages.
     */
    protected $message;

    /**
     * Constructor to inject dependencies.
     * 
     * @param RoleRepository $roleRepository The repository to handle role-related data.
     * @param LogErrorInterface $logError Service for logging errors.
     * @param CustomeMessageInterface $customMessage Service for flashing messages.
     */
    public function __construct(
        RoleRepository $roleRepository,
        LogErrorInterface $logError,
        CustomeMessageInterface $customMessage
    ) {
        // Assigning the injected services to class properties
        $this->roleRepository = $roleRepository;
        $this->logError = $logError;
        $this->message = $customMessage;
    }

    /**
     * Fetch all roles from the repository.
     * 
     * @return mixed
     */
    public function getAll()
    {
        try {
            return $this->roleRepository->paginate();  // Calling the all() method from RoleRepository
        } catch (\Exception $e) {
            // If an error occurs, log it and flash an error message
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to fetch roles!');
            throw $e;  // Re-throwing the exception
        }
    }

    /**
     * Fetch a role by its ID from the repository.
     * 
     * @param int $id The ID of the role to fetch.
     * @return mixed
     */
    public function getById(int $id)
    {
        try {
            return $this->roleRepository->find($id);  // Calling the find() method from RoleRepository
        } catch (\Exception $e) {
            // If an error occurs, log it and flash an error message
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to fetch role!');
            throw $e;  // Re-throwing the exception
        }
    }

    /**
     * Create a new role.
     * 
     * @param array $data The data to create the new role.
     * @return mixed
     */
    public function create(array $data)
    {
        try {
            // Calling the create() method from RoleRepository to insert a new role
            $role = $this->roleRepository->create($data);
            $this->message->flashMessage('success', 'Role created successfully!');  // Flash success message
            return $role;  // Return the newly created role
        } catch (\Exception $e) {
            // If an error occurs, log it and flash an error message
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to create role!');
            throw $e;  // Re-throwing the exception
        }
    }

    /**
     * Update an existing role by its ID.
     * 
     * @param array $data The data to update the role.
     * @param int $id The ID of the role to update.
     * @return mixed
     */
    public function update(array $data, int $id)
    {
        try {
            // Calling the update() method from RoleRepository to update the role
            $role = $this->roleRepository->update($data, $id);
            $this->message->flashMessage('success', 'Role updated successfully.');  // Flash success message
            return $role;  // Return the updated role
        } catch (\Exception $e) {
            // If an error occurs, log it and flash an error message
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to update role!');
            throw $e;  // Re-throwing the exception
        }
    }

    /**
     * Delete a role by its ID.
     * 
     * @param int $id The ID of the role to delete.
     * @return mixed
     */
    public function delete(int $id)
    {
        try {
            // Calling the delete() method from RoleRepository to delete the role
            $role = $this->roleRepository->delete($id);
            $this->message->flashMessage('success', 'Role deleted successfully.');  // Flash success message
            return $role;  // Return the deleted role
        } catch (\Exception $e) {
            // If an error occurs, log it and flash an error message
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to delete role!');
            throw $e;  // Re-throwing the exception
        }
    }

    /**
     * Assign a role to a user.
     * 
     * @param array $data The data to assign the role to the user.
     * @return void
     */
    public function assignRoleToUser(array $data)
    {
        try {
            $this->roleRepository->assignRole($data);  // Assigning the role to the user
            $this->message->flashMessage('success', 'Role assigned to user successfully!');  // Flash success message
        } catch (\Exception $e) {
            // If an error occurs, log it and flash an error message
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to assign role to user!');
            throw $e;  // Re-throwing the exception
        }
    }

    /**
     * Revoke a role from a user.
     * 
     * @param array $data The data to revoke the role from the user.
     * @return void
     */
    public function revokeRoleToUser(array $data)
    {
        try {
            $this->roleRepository->revokeRole($data);  // Revoking the role from the user
            $this->message->flashMessage('success', 'Role revoked from user successfully!');  // Flash success message
        } catch (\Exception $e) {
            // If an error occurs, log it and flash an error message
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to revoke role from user!');
            throw $e;  // Re-throwing the exception
        }
    }

    /**
     * Assign a permission to a role.
     * 
     * @param array $data The data to assign the permission to the role.
     * @return void
     */
    public function assignPermissionToRole(array $data)
    {
        try {
            $this->roleRepository->syncPermissions($data);  // Assigning the permission to the role
            $this->message->flashMessage('success', 'Permission assigned to role successfully!');  // Flash success message
        } catch (\Exception $e) {
            // If an error occurs, log it and flash an error message
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to assign permission to role!');
            throw $e;  // Re-throwing the exception
        }
    }

    /**
     * Revoke a permission from a role.
     * 
     * @param array $data The data to revoke the permission from the role.
     * @return void
     */
    public function revokePermissionToRole(array $data)
    {
        try {
            $this->roleRepository->revokePermissions($data);  // Revoking the permission from the role
            $this->message->flashMessage('success', 'Permission revoked from role successfully!');  // Flash success message
        } catch (\Exception $e) {
            // If an error occurs, log it and flash an error message
            $this->logError->logError($e->getMessage(), ['context' => $e]);
            $this->message->flashMessage('error', 'Failed to revoke permission from role!');
            throw $e;  // Re-throwing the exception
        }
    }
}

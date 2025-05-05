<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;  // Importing the Permission model to work with
/**
 * PermissionRepository handles the data access logic for the Permission model.
 * It extends the BaseRepository to utilize common CRUD operations.
 */
class PermissionRepository extends BaseRepository
{
    /**
     * @var Permission
     * The permission model instance.
     */
    protected $permission;

    /**
     * Constructor to inject the Permission model.
     * 
     * @param Permission $permission The permission model to be injected.
     */
    public function __construct(Permission $permission)
    {
        // Calling the parent constructor of BaseRepository, passing the injected permission model
        parent::__construct($permission);
    }
    /**
     * Assign one or multiple permissions to a user.
     *
     * @param array $data Array containing 'user_id' and 'permissions'.
     *                     'permissions' can be a single permission name or an array of names.
     * @return bool True on success.
     * @throws \Exception If user or permissions are not found, or assignment fails.
     */
    public function assignPermission(array $data)
    {
        try {
            // Validate required input fields
            if (!isset($data['user_id']) || !isset($data['permissions'])) {
                throw new \Exception('Missing user_id or permissions in data.');
            }

            // Find the user by ID
            $user = User::findOrFail($data['user_id']);

            // Normalize permissions input to an array
            $permissions = is_array($data['permissions']) ? $data['permissions'] : [$data['permissions']];

            // Retrieve permissions by their names
            $permissionModels = Permission::whereIn('name', $permissions)->get();

            // If no permissions are found, throw an exception
            if ($permissionModels->isEmpty()) {
                throw new \Exception('No valid permissions found.');
            }

            // Assign permissions to the user
            $user->givePermissionTo($permissionModels);

            return true;
        } catch (\Exception $e) {
            // Log the error with context for debugging
            Log::error('Error assigning permission: ' . $e->getMessage(), [
                'user_id' => $data['user_id'] ?? null,
                'permissions' => $data['permissions'] ?? null,
            ]);
            throw new \Exception('Error assigning permission: ' . $e->getMessage());
        }
    }


    /**
     * Revoke one or multiple permissions from a user.
     *
     * @param array $data Array containing 'user_id' and 'permissions'.
     *                     'permissions' can be a single permission name or an array of names.
     * @return bool True on success.
     * @throws \Exception If user or permissions are not found, or revocation fails.
     */
    public function revokePermission(array $data)
    {
        try {
            // Validate required input fields
            if (!isset($data['user_id']) || !isset($data['permissions'])) {
                throw new \Exception('Missing user_id or permissions in data.');
            }

            // Find the user by ID
            $user = User::findOrFail($data['user_id']);

            // Normalize permissions input to an array
            $permissions = is_array($data['permissions']) ? $data['permissions'] : [$data['permissions']];

            // Retrieve permissions by their names
            $permissionModels = Permission::whereIn('name', $permissions)->get();

            // If no permissions are found, throw an exception
            if ($permissionModels->isEmpty()) {
                throw new \Exception('No valid permissions found.');
            }

            // Revoke permissions from the user
            $user->revokePermissionTo($permissionModels);

            return true;
        } catch (\Exception $e) {
            // Log the error with context for debugging
            Log::error('Error revoking permission: ' . $e->getMessage(), [
                'user_id' => $data['user_id'] ?? null,
                'permissions' => $data['permissions'] ?? null,
            ]);
            throw new \Exception('Error revoking permission: ' . $e->getMessage());
        }
    }
}

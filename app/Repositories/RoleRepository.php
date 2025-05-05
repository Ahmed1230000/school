<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $role)
    {
        parent::__construct($role);
    }

    /**
     * Assigns a role to a user.
     *
     * @param array $data Array containing 'user_id' and 'role_id'.
     * @return bool True on success, false on failure.
     * @throws Exception If an error occurs during role assignment.
     */
    public function assignRole(array $data)
    {
        try {
            // Validate input data
            if (!isset($data['user_id']) || !isset($data['role_id'])) {
                throw new Exception('Missing user_id or role_id in data.');
            }

            // Find the user by ID
            $user = User::findOrFail($data['user_id']);

            // Find the role by ID
            $role = Role::findOrFail($data['role_id']);

            // Assign the role to the user using Spatie's assignRole method
            $user->assignRole($role);

            return true;
        } catch (Exception $e) {
            Log::error('Error assigning role: ' . $e->getMessage(), [
                'user_id' => $data['user_id'] ?? null,
                'role_id' => $data['role_id'] ?? null,
            ]);
            throw new Exception('Error assigning role: ' . $e->getMessage());
        }
    }

    /**
     * Revokes a role from a user.
     *
     * @param array $data Array containing 'user_id' and 'role_id'.
     * @return bool True on success, false on failure.
     * @throws Exception If an error occurs during role revocation.
     */

    public function revokeRole(array $data)
    {
        try {
            // Validate input data
            if (!isset($data['user_id']) || !isset($data['role_id'])) {
                throw new Exception('Missing user_id or role_id in data.');
            }

            // Find the user by ID
            $user = User::findOrFail($data['user_id']);

            // Find the role by ID
            $role = Role::findOrFail($data['role_id']);

            if ($user->hasRole($role)) {
                // Revoke the role from the user using Spatie's revokeRole method
                $user->removeRole($role);
            } else {
                throw new Exception('User does not have this role.');
            }


            return true;
        } catch (Exception $e) {
            Log::error('Error revoking role: ' . $e->getMessage(), [
                'user_id' => $data['user_id'] ?? null,
                'role_id' => $data['role_id'] ?? null,
            ]);
            throw new Exception('Error revoking role: ' . $e->getMessage());
        }
    }

    /**
     * Syncs permissions for a role.
     *
     * @param array $data Array containing 'role_id' and 'permissions'.
     * @return bool True on success, false on failure.
     * @throws Exception If an error occurs during permission assignment.
     */
    public function syncPermissions(array $data)
    {
        try {
            // Validate input data
            if (!isset($data['role_id']) || !isset($data['permissions'])) {
                throw new Exception('Missing role_id or permissions in data.');
            }

            // Find the role by ID
            $role = Role::findOrFail($data['role_id']);

            // Sync permissions using Spatie's syncPermissions method
            $role->givePermissionTo($data['permissions']);

            return true;
        } catch (Exception $e) {
            Log::error('Error syncing permissions: ' . $e->getMessage(), [
                'role_id' => $data['role_id'] ?? null,
                'permissions' => $data['permissions'] ?? null,
            ]);
            throw new Exception('Error syncing permissions: ' . $e->getMessage());
        }
    }

    public function revokePermissions(array $data)
    {
        try {
            // Validate input data
            if (!isset($data['role_id']) || !isset($data['permissions'])) {
                throw new Exception('Missing role_id or permissions in data.');
            }

            // Find the role by ID
            $role = Role::findOrFail($data['role_id']);

            // Revoke permissions using Spatie's revokePermissionTo method
            $role->revokePermissionTo($data['permissions']);

            return true;
        } catch (Exception $e) {
            Log::error('Error revoking permissions: ' . $e->getMessage(), [
                'role_id' => $data['role_id'] ?? null,
                'permissions' => $data['permissions'] ?? null,
            ]);
            throw new Exception('Error revoking permissions: ' . $e->getMessage());
        }
    }
}

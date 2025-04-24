<?php

namespace App\Http\Controllers\RoleAndPermissions;

use App\Helpers\CustomMessage;
use App\Helpers\LogError;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignPermissionToRoleFormRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class AssignPermissionToRoleController extends Controller
{
    use CustomMessage, LogError;

    public function showAssignPermissionToRoleForm()
    {
        try {
            // Fetch all roles and permissions from the database
            $roles = Role::all();
            $permissions = Permission::all();

            // Pass the roles and permissions to the view
            return view('assign-permission-to-role.assign-permission-to-role', compact('roles', 'permissions'));
        } catch (\Exception $e) {
            $this->logError('Error loading assign permission form', [
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Failed to load form');
        }
    }

    public function showRevokePermissionToRoleForm()
    {
        try {
            // Fetch all roles and permissions from the database
            $roles = Role::all();
            $permissions = Permission::all();

            // Pass the roles and permissions to the view
            return view('revoke-permission-from-role.revoke-permission-from-role', compact('roles', 'permissions'));
        } catch (\Exception $e) {
            $this->logError('Error loading revoke permission form', [
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Failed to load form');
        }
    }

    public function assignPermissionToRole(AssignPermissionToRoleFormRequest $request)
    {
        try {
            $validated = $request->validated();
            $role = Role::findOrFail($validated['role_id']);
            $permissions = $validated['permissions'];

            // Log the received permissions for debugging
            Log::info('Received Permissions:', ['permissions' => $permissions]);

            if (empty($permissions)) {
                $this->flashMessage('error', 'Please select at least one permission !.');
                return redirect()->back();
            }

            // Sync permissions
            $role->syncPermissions($permissions);
            $this->flashMessage('success', 'Permissions assigned successfully');
            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            $this->logError('Error assigning permissions to role', [
                'error' => $e->getMessage(),
                'permissions' => $request->validated()['permissions'] ?? [],
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while assigning permissions: ' . $e->getMessage());
        }
    }
    public function revokePermissionFromRole(AssignPermissionToRoleFormRequest $request)
    {
        try {
            $validated = $request->validated();
            $role = Role::findOrFail($validated['role_id']);
            $permissions = $validated['permissions'];

            // Log the received permissions for debugging
            Log::info('Received Permissions:', ['permissions' => $permissions]);

            if (empty($permissions)) {
                return redirect()->back()->withInput()->with('error', 'Please select at least one permission !.');
            }

            // Revoke permissions
            $role->revokePermissionTo($permissions);
            $this->flashMessage('success', 'Permissions revoked successfully');
            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            $this->logError('Error revoking permissions from role', [
                'error' => $e->getMessage(),
                'permissions' => $request->validated()['permissions'] ?? [],
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while revoking permissions: ' . $e->getMessage());
        }
    }
}

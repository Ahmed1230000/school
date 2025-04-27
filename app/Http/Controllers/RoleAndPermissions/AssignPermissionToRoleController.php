<?php

namespace App\Http\Controllers\RoleAndPermissions;

use App\Helpers\CustomMessage;
use App\Helpers\LogError;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignPermissionToRoleFormRequest;
use App\Service\RoleService;
use Exception;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class AssignPermissionToRoleController extends Controller
{
    use CustomMessage, LogError;
    protected $roleService;
    public function __construct(RoleService $roleService)
    {
        // Constructor logic if needed
        $this->roleService = $roleService;
    }
    public function showAssignPermissionToRoleForm()
    {
        try {
            // Fetch all roles and permissions from the database
            $roles = Role::all();
            $permissions = Permission::all();

            // Pass the roles and permissions to the view
            return view('assign-permission-to-role.assign-permission-to-role', compact('roles', 'permissions'));
        } catch (Exception $e) {
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
        } catch (Exception $e) {
            $this->logError('Error loading revoke permission form', [
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Failed to load form');
        }
    }

    public function assignPermissionToRole(AssignPermissionToRoleFormRequest $request)
    {
        try {
            $this->roleService->assignPermissionToRole($request->validated());
            return redirect()->route('roles.index');
        } catch (Exception $e) {
            $this->logError('Error assigning role from user: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return redirect()->back()->withInput();
        }
    }
    public function revokePermissionFromRole(AssignPermissionToRoleFormRequest $request)
    {
        try {
            $this->roleService->revokePermissionToRole($request->validated());
            return redirect()->route('roles.index');
        } catch (Exception $e) {
            $this->logError('Error revoking role from user: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return redirect()->back()->withInput();
        }
    }
}

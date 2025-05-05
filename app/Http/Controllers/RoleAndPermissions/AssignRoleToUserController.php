<?php

namespace App\Http\Controllers\RoleAndPermissions;

use App\Helpers\LogError;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignRoleToUserFormRequest;
use App\Models\User;
use App\Service\RoleService;
use Exception;
use Spatie\Permission\Models\Role;

class AssignRoleToUserController extends Controller
{
    use LogError;

    protected $roleService;
    public function __construct(RoleService $roleService)
    {
        // Constructor logic if needed
        $this->roleService = $roleService;
    }

    public function showAssignRoleToUserForm()
    {
        $users = User::all();
        $roles = Role::all();
        return view('assign-role-to-user.assign-role-to-user', compact('users', 'roles'));
    }
    public function showRevokeRoleToUserForm()
    {
        $users = User::all();
        $roles = Role::all();
        return view('revoke-role-from-user.revoke-role-from-user', compact('users', 'roles'));
    }


    public function assignRoleToUser(AssignRoleToUserFormRequest $request)
    {
        try {
            $this->roleService->assignRoleToUser($request->validated());
            return redirect()->route('roles.index');
        } catch (Exception $e) {
            // Log the error
            $this->logError('Error creating permission: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return redirect()->back()->withInput();
        }
    }
    public function revokeRoleFromUser(AssignRoleToUserFormRequest $request)
    {
        try {
            $this->roleService->revokeRoleToUser($request->validated());
            return redirect()->route('roles.index');
        } catch (Exception $e) {
            // Log the error
            $this->logError('Error revoking role from user: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return redirect()->back()->withInput();
        }
    }
}

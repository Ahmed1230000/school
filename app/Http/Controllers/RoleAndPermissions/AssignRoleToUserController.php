<?php

namespace App\Http\Controllers\RoleAndPermissions;

use App\Helpers\CustomMessage;
use App\Helpers\LogError;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignRoleToUserFormRequest;
use App\Models\User;
use Exception;
use Spatie\Permission\Models\Role;

class AssignRoleToUserController extends Controller
{
    use CustomMessage, LogError;
    public function showAssignRoleToUserForm()
    {
        $users = User::all();
        $roles = Role::all();
        // Pass the users and roles to the view
        return view('assign-role-to-user.assign-role-to-user', compact('users', 'roles'));
    }
    public function showRevokeRoleToUserForm()
    {
        $users = User::all();
        $roles = Role::all();
        // Pass the users and roles to the view
        return view('revoke-role-from-user.revoke-role-from-user', compact('users', 'roles'));
    }


    public function assignRoleToUser(AssignRoleToUserFormRequest $request)
    {
        try {
            $data = $request->validated();

            $user = User::findOrFail($data['user_id']);
            $role = Role::findOrFail($data['role_id']);

            $user->syncRoles([$role->name]);

            $this->flashMessage('success', 'Role assigned successfully');
            return redirect()->route('roles.index');
        } catch (Exception $e) {
            // Log the error
            $this->logError('Error creating permission: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            // Handle the exception
            return $this->flashMessage('error', 'An error occurred while assigning the role.');
        }
    }
    public function revokeRoleFromUser(AssignRoleToUserFormRequest $request)
    {
        try {
            $data = $request->validated();

            $user = User::findOrFail($data['user_id']);
            $role = Role::findOrFail($data['role_id']);

            if ($user->hasRole($role->name)) {
                $user->removeRole($role->name);
                $this->flashMessage('success', 'Role revoked successfully');
            } else {
                $this->flashMessage('warning', 'The user does not have this role.');
            }

            return redirect()->route('roles.index');
        } catch (Exception $e) {
            // Log the error
            $this->logError('Error revoking role from user: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            // Handle the exception
            $this->flashMessage('error', 'An error occurred while revoking the role.');
            return redirect()->route('revoke-role-from-user.show');
        }
    }
}

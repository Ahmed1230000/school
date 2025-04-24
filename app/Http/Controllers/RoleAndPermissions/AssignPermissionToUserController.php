<?php

namespace App\Http\Controllers\RoleAndPermissions;

use App\Helpers\CustomMessage;
use App\Helpers\LogError;
use App\Http\Requests\AssignPermissionToUserFormRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class AssignPermissionToUserController extends Controller
{
    use CustomMessage, LogError;

    public function showAssignPermissionToUserForm()
    {
        $users = User::all();
        $permissions = Permission::all();
        // Pass the users and permissions to the view
        return view('assign-permission-to-user.assign-permission-to-user', compact('users', 'permissions'));
    }
    public function showRevokePermissionToUserForm()
    {
        $users = User::all();
        $permissions = Permission::all();
        // Pass the users and permissions to the view
        return view('revoke-permission-from-user.revoke-permission-from-user', compact('users', 'permissions'));
    }

    public function assignPermissionToUser(AssignPermissionToUserFormRequest $request)
    {
        try {
            $user = User::findOrFail($request->validated()['user_id']);
            $permission = $request->validated()['permissions'];

            if (empty($permission)) {
                $this->flashMessage('error', 'Please select at least one permission.');
                return redirect()->back();
            }

            $user->syncPermissions($permission);

            $this->flashMessage('success', 'Permission assigned successfully');
            return redirect()->route('permissions.index');
        } catch (Exception $e) {
            // Log the error
            $this->logError('Error creating permission: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            // Handle the exception
            return $this->flashMessage('error', 'An error occurred while assigning the permission. Please try again later.');
        }
    }
    public function revokePermissionFromUser(AssignPermissionToUserFormRequest $request)
    {
        try {
            $user = User::findOrFail($request->validated()['user_id']);
            $permission = $request->validated()['permissions'];

            if (empty($permission)) {
                $this->flashMessage('error', 'Please select at least one permission.');
                return redirect()->back();
            }

            $user->revokePermissionTo($permission);

            $this->flashMessage('success', 'Permission revoked successfully');
            return redirect()->route('permissions.index');
        } catch (Exception $e) {
            // Log the error
            $this->logError('Error creating permission: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            // Handle the exception
            return $this->flashMessage('error', 'An error occurred while assigning the permission. Please try again later.');
        }
    }
}

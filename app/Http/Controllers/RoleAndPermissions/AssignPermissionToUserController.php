<?php

namespace App\Http\Controllers\RoleAndPermissions;

use App\Helpers\CustomMessage;
use App\Helpers\LogError;
use App\Http\Requests\AssignPermissionToUserFormRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\PermissionService;
use Spatie\Permission\Models\Permission;

class AssignPermissionToUserController extends Controller
{
    use CustomMessage, LogError;

    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

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
            $this->permissionService->assignPermissionToUser($request->validated());
            return redirect()->route('permissions.index');
        } catch (Exception $e) {
            $this->logError('Error loading assign permission form', [
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Failed to load form');
        }
    }
    public function revokePermissionFromUser(AssignPermissionToUserFormRequest $request)
    {
        try {
            $this->permissionService->revokePermissionToUser($request->validated());
            return redirect()->route('permissions.index');
        } catch (Exception $e) {
            $this->logError('Error loading revoke permission form', [
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Failed to load form');
        }
    }
}

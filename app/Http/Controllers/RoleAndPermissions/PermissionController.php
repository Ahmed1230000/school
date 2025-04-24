<?php

namespace App\Http\Controllers\RoleAndPermissions;

use App\Helpers\CustomMessage;
use App\Helpers\LogError;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionStoreFormRequest;
use App\Http\Requests\PermissionUpdateFormRequest;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    use LogError, CustomMessage;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Fetch all permission from the database
            $permissions = Permission::all();

            // Return the view with the permission data
            return view('permission.index-permission', compact('permissions'));
        } catch (\Exception $e) {
            // Handle the exception
            $this->logError('Error fetching permission: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            $this->flashMessage('error', 'Failed to fetch permission.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            // Fetch all permission from the database
            $permissions = Permission::all();

            // Return the view with the permission data
            return view('permission.create-permission', compact('permissions'));
        } catch (\Exception $e) {
            // Handle the exception
            $this->logError('Error fetching permission: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            $this->flashMessage('error', 'Failed to fetch permission.');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionStoreFormRequest $request)
    {
        try {
            // Create a new permission
            $permission = Permission::create($request->validated());
            if ($permission) {
                // Flash success message
                $this->flashMessage('success', 'Permission created successfully.');
                return redirect()->route('permissions.index');
            }
            // Redirect to the index page
        } catch (\Exception $e) {
            // Handle the exception
            $this->logError('Error creating permission: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            $this->flashMessage('error', 'Failed to create permission.');

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Fetch the permission by ID
            $permission = Permission::findOrFail($id);
            // Return the view with the permission data
            return view('permission.show-permission', compact('permission'));
        } catch (\Exception $e) {
            // Handle the exception
            $this->logError('Error fetching permission: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            $this->flashMessage('error', 'Failed to fetch permission.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            // Fetch the permission by ID
            $permission = Permission::findOrFail($id);

            // Return the view with the permission data
            return view('permission.edit-permission', compact('permission'));
        } catch (\Exception $e) {
            // Handle the exception
            $this->logError('Error fetching permission: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            $this->flashMessage('error', 'Failed to fetch permission.');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionUpdateFormRequest $request, string $id)
    {
        try {
            // Fetch the permission by ID
            $permission = Permission::findOrFail($id);

            // Update the permission
            $permission->update($request->validated());

            // Flash success message
            $this->flashMessage('success', 'Permission updated successfully.');

            // Redirect to the index page
            return redirect()->route('permissions.index');
        } catch (\Exception $e) {
            // Handle the exception
            $this->logError('Error updating permission: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            $this->flashMessage('error', 'Failed to update permission.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Fetch the permission by ID
            $permission = Permission::findOrFail($id);

            // Delete the permission
            $permission->delete();

            // Flash success message
            $this->flashMessage('success', 'Permission deleted successfully.');

            // Redirect to the index page
            return redirect()->route('permissions.index');
        } catch (\Exception $e) {
            // Handle the exception
            $this->logError('Error deleting permission: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            $this->flashMessage('error', 'Failed to delete permission.');
            return redirect()->back();
        }
    }
}

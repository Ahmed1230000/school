<?php

namespace App\Http\Controllers\RoleAndPermissions;

use App\Helpers\CustomMessage;
use App\Helpers\LogError;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreFormRequest;
use App\Http\Requests\RoleUpdateFormRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use LogError, CustomMessage;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Fetch all roles from the database
            $roles = Role::all();

            // Return the view with the roles data
            return view('roles.index-role', compact('roles'));
        } catch (\Exception $e) {
            // Handle the exception
            $this->logError('Error fetching roles: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            $this->flashMessage('error', 'Failed to fetch roles.');
            return redirect()->back();
        }
    }

    /** 
     * 
     * 
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            // Fetch all roles from the database
            $roles = Role::all();
            // Return the view with the roles data
            return view('roles.create-role', compact('roles'));
        } catch (\Exception $e) {
            // Handle the exception
            $this->logError('Error fetching roles: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            $this->flashMessage('error', 'Failed to fetch roles.');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreFormRequest $request)
    {
        try {
            // Create a new role
            $role = Role::createOrFirst($request->validated());
            if ($role) {
                $this->flashMessage('success', 'Role created successfully.');
                return redirect()->route('roles.index');
            }
        } catch (\Exception $e) {
            // Handle the exception
            $this->logError('Error creating role: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            $this->flashMessage('error', 'Failed to create role.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Fetch the role by ID
            $role = Role::findOrFail($id);
            // Return the view with the role data
            return view('roles.show-role', compact('role'));
        } catch (\Exception $e) {
            // Handle the exception
            $this->logError('Error fetching role: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            $this->flashMessage('error', 'Failed to fetch role.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            // Fetch the role by ID
            $role = Role::findOrFail($id);
            // Return the view with the role data
            return view('roles.edit-role', compact('role'));
        } catch (\Exception $e) {
            // Handle the exception
            $this->logError('Error fetching role: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            $this->flashMessage('error', 'Failed to fetch role.');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateFormRequest $request, string $id)
    {
        try {
            // Find the role by ID
            $role = Role::findOrFail($id);
            // Update the role with the validated data
            $role->update($request->validated());
            $this->flashMessage('success', 'Role updated successfully.');
            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            // Handle the exception
            $this->logError('Error updating role: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            $this->flashMessage('error', 'Failed to update role.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the role by ID
            $role = Role::findOrFail($id);
            // Delete the role
            $role->delete();
            $this->flashMessage('success', 'Role deleted successfully.');
            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            // Handle the exception
            $this->logError('Error deleting role: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            $this->flashMessage('error', 'Failed to delete role.');
            return redirect()->back();
        }
    }
}

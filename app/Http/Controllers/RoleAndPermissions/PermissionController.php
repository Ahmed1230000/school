<?php

namespace App\Http\Controllers\RoleAndPermissions;

use App\Contracts\ServiceInterface;
use App\Helpers\CustomMessage;
use App\Helpers\LogError;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionStoreFormRequest;
use App\Http\Requests\PermissionUpdateFormRequest;
use App\Service\PermissionService;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    use LogError;
    protected $permissionService;
    /**
     * Constructor to inject dependencies
     */
    public function __construct(PermissionService $permissionService)
    {
        // Dependency injection of the permission service
        $this->permissionService = $permissionService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $permissions = $this->permissionService->getAll();
            return view('permission.index-permission', compact('permissions'));
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('permission.create-permission');
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionStoreFormRequest $request)
    {
        try {
            $permission = $this->permissionService->create($request->validated());
            return redirect()->route('permissions.index');
            // Redirect to the index page
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $permission = $this->permissionService->getById($id);
            return view('permission.show-permission', compact('permission'));
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $permission = $this->permissionService->getById($id);
            // Return the view with the permission data
            return view('permission.edit-permission', compact('permission'));
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionUpdateFormRequest $request, string $id)
    {
        try {
            $this->permissionService->update($request->validated(), $id);
            return redirect()->route('permissions.index');
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->permissionService->delete($id);
            return redirect()->route('permissions.index');
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back();
        }
    }
}

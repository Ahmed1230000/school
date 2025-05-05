<?php

namespace App\Http\Controllers\RoleAndPermissions;

use App\Contracts\ServiceInterface;
use App\Helpers\LogError;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreFormRequest;
use App\Http\Requests\RoleUpdateFormRequest;
use App\Service\RoleService;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use LogError;
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        try {
            $roles = $this->roleService->getAll();
            return view('roles.index-role', compact('roles'));
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back();
        }
    }

    public function create()
    {
        return view('roles.create-role');
    }

    public function store(RoleStoreFormRequest $request)
    {
        try {
            $this->roleService->create($request->validated());
            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back()->withInput();
        }
    }

    public function show(string $id)
    {
        try {
            $role = $this->roleService->getById($id);
            return view('roles.show-role', compact('role'));
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back();
        }
    }

    public function edit(string $id)
    {
        try {
            $role = $this->roleService->getById($id);
            return view('roles.edit-role', compact('role'));
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back();
        }
    }

    public function update(RoleUpdateFormRequest $request, string $id)
    {
        try {
            $this->roleService->update($request->validated(), $id);
            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->roleService->delete($id);
            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            // Log the error message and context
            $this->logError($e->getMessage(), ['context' => $e]);

            return redirect()->back();
        }
    }
}

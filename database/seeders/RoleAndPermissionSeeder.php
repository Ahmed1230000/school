<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createRoles();
        $this->createPermissions();
        $this->assignPermissionsToRoles();
        $this->assignModelPermissions('user');
    }

    protected function createRoles()
    {
        $roleNames = [
            'super-admin',
            'admin',
            'user',
        ];

        foreach ($roleNames as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }
    }

    protected function createPermissions()
    {
        $modelNames = ['user'];
        $actions = ['index', 'store', 'show', 'update', 'delete'];

        foreach ($modelNames as $model) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "{$model}-{$action}",
                    'guard_name' => 'web'
                ]);
            }
        }
    }

    protected function assignPermissionsToRoles()
    {
        $models = ['user'];

        foreach ($models as $model) {
            $this->assignModelPermissions($model);
        }
    }

    protected function assignModelPermissions(string $model)
    {
        $allPermissions = [
            'super-admin' => ['index', 'store', 'show', 'update', 'delete'],
            'admin' => ['index', 'show', 'update'],
            'user' => ['show', 'update']
        ];

        foreach ($allPermissions as $role => $actions) {
            $permissions = array_map(fn($action) => "{$model}-{$action}", $actions);
            Role::findByName($role)->syncPermissions($permissions);
        }
    }
}

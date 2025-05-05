<?php

namespace App\Contracts;


interface RoleUserInterface
{
    public function showAssignRoleToUserForm();
    public function showRevokeRoleToUserForm();
    public function assignRoleToUser(array $data);
    public function revokeRoleFromUser(array $data);
}

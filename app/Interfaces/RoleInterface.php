<?php
namespace App\Interfaces;

interface RoleInterface {
    public function getAllPermission();
    public function getAllRoles();
    public function storeRole($request);
    public function getRoleById($id);
    public function getRolesOnlyNames();
}
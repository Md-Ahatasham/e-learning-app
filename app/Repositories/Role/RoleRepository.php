<?php
namespace App\Repositories\Role;

use App\Interfaces\RoleInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleInterface{

    public function getAllPermission()
    {
        return Permission::get();
    }

    public function getAllRoles()
    {
        return Role::orderBy('id', 'DESC')->get();
    }


    public function storeRole($request)
    {
        return Role::create($request);
    }

    public function getRoleById($id)
    {
        return Role::find($id);
    }

    /**
     * @param $id
     * @return array
     */
    public function getPermissionWithRole($id): array
    {
        return DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')->all();
    }

    public function getRolesOnlyNames()
    {
        return Role::pluck('name','name')->all();
    }

    public function deleteRoleById($id)
    {
        return Role::find($id)->delete();
    }
}

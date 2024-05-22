<?php
namespace App\Services\Role;

use App\Http\Controllers\Controller;
use App\Repositories\Role\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleService extends Controller {
    protected $repository;

    public function __construct(RoleRepository $repository){
        $this->repository = $repository;
    }

    public function getAllRoles()
    {
        return $this->repository->getAllRoles();
    }

    public function getPermissionList()
    {
        return $this->repository->getAllPermission();
    }

    public function storeRoleWithPermission($request)
    {
        $role = $this->repository->storeRole(['name' => $request['name']]);
        $role->syncPermissions($request['permission']);
    }

    public function getPermissionAssociatedWithRole($id): array
    {
        $data['role'] = $this->repository->getRoleById($id);
        $data['permission'] = $this->repository->getAllPermission();
        $data['rolePermissions'] = $this->repository->getPermissionWithRole($id);
        return $data;
    }

    public function updatePermissionAssociatedWithRole($request, $id): bool
    {
        $role = $this->repository->getRoleById($id);
        $role->syncPermissions($request['permission']);
        return true;
    }

    public function deleteRoleById($id)
    {
        return $this->repository->deleteRoleById($id);
    }

}

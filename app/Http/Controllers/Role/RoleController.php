<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Services\Role\RoleService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    protected $service;

    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }


    /**
     * Display a list of roles.
     * @date: 02-03-2022
     * @return Application|Factory|View
     */

    public function index()
    {
        $data['roles'] = $this->service->getAllRoles();
        $data['breadcrumb'] = $this->getBreadcrumb("Roles", "Role list");
        return view('admin_level.roles.index', with(['data' => $data]));
    }


    /**
     * Show the form for creating user roles.
     * @date: 02-03-2022
     * @return Application|Factory|View
     */

    public function create()
    {
        $data['permission'] = $this->service->getPermissionList();
        $data['breadcrumb'] = $this->getBreadcrumb("Roles", "Add Roles");
        $data['roleList'] = $this->role();
        return view('admin_level.roles.create', with(['data' => $data]));
    }


    /**
     * Store a newly created permission to role.
     * @date: 02-03-2022
     * @param Request $request
     * @return RedirectResponse
     */

    public function store(Request $request): RedirectResponse
    {
        try {
            $request->merge(['name' => ucfirst($request->input('name'))]);
            $this->validate($request, [
                'name' => 'required|unique:roles,name',
                'permission' => 'required',
            ]);

            $this->service->storeRoleWithPermission($request->all());
            return redirect()->route('roles.index')->with('toast_success', 'Permission assigned successfully !');
        } catch (Exception $ex) {
            return redirect()->route('roles.index')->with('toast_error', 'Ops! Something went wrong.');
        }

    }


    /**
     * Show the form for editing permission for role.
     * @date: 02-03-2022
     * @param int $id
     * @return Application|Factory|View
     */

    public function edit(int $id)
    {
        $data = $this->service->getPermissionAssociatedWithRole($id);
        $data['breadcrumb'] = $this->getBreadcrumb("Roles", "Update Permissions");
        return view('admin_level.roles.edit', with(['data' => $data]));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */

    public function update(Request $request, int $id): RedirectResponse
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'permission' => 'required',
            ]);

            $this->service->updatePermissionAssociatedWithRole($request->all(),$id);
            return redirect()->route('roles.index')->with('toast_success', 'Permission updated successfully');
        } catch (\Exception $ex){
            return redirect()->route('roles.index')->with('toast_error', 'Ops! Something went wrong.');
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->service->deleteRoleById($id);
            return redirect()->route('roles.index')->with('toast_success', 'Role deleted successfully!');
        } catch (Exception $ex){
            return redirect()->route('roles.index')->with('toast_error', 'Ops! Something went wrong');
        }

    }
}

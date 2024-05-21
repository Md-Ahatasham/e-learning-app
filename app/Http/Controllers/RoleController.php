<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:role-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a list of roles.
     * @date: 02-03-2022
     * @return array of role list
     */

    public function index()
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        $breadcrumb_data['title'] = "Roles";
        $breadcrumb_data['headline'] = "Roles List";
        return view('admin_level.roles.index', with(['roles' => $roles, 'data' => $breadcrumb_data]));
    }


    /**
     * Show the form for creating user roles.
     * @date: 02-03-2022
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $permission = Permission::get();
        $breadcrumb_data['title'] = "Roles";
        $breadcrumb_data['headline'] = "Add Roles";
        $roleList = $this->role();
        return view('admin_level.roles.create', with(['permission' => $permission, 'data' => $breadcrumb_data,'roleList'=>$roleList]));
    }


    /**
     * Store a newly created permission to role.
     * @date: 02-03-2022
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')->with('toast_success', 'Permission assigned successfully !');
    }


    /**
     * Display the specific role's permission.
     * @date: 02-03-2022
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)->get();
        return view('admin_level.roles.show', compact('role', 'rolePermissions'));
    }


    /**
     * Show the form for editing permission for role.
     * @date: 02-03-2022
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')->all();

        $breadcrumb_data['title'] = "Roles";
        $breadcrumb_data['headline'] = "Update Permissions";
        $roles = Role::pluck('name','name')->all();
        return view('admin_level.roles.edit', with(['role' => $role,'roles' => $roles, 'permission' => $permission, 'rolePermissions' => $rolePermissions, 'data' => $breadcrumb_data]));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')->with('toast_success', 'Permission updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index')->with('toast_success', 'Role Deleted Successfully!');
    }
}

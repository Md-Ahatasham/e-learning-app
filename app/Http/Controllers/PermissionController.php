<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permission-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumb_data['title'] = "Permission";
        $data = Permission::orderBy('id', 'DESC')->get();
        return view('admin_level.permission.index')->with(['all_permissions' => $data, 'data' => $breadcrumb_data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Permission;
        $post->name = $request->name;
        $post->guard_name = $request->guard_name;
        $post->save();
        return redirect()->route('permission.index')->with('success', 'Data has been updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Permission::destroy($id)) {
            return redirect()->route('permission.index')->with('success', 'Data has been deleted successfully !');
        } else {
            return redirect()->route('permission.index')->with('warning', 'Something went wrong !');
        }
    }
}

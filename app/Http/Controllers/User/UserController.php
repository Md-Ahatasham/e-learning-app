<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    protected $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of users.
     * @date: 01-04-2022
     * @param: null
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = $this->service->getUserInfo();
        $data['breadcrumb'] = $this->getBreadcrumb('User','User list');
        return view('admin_level.users.index', with(['data' => $data]));
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->formValidation($request);
        $this->service->storeUser($request);
        return redirect()->route('users.index')->with('toast_success', 'User Created Successfully');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request): RedirectResponse
    {
        $this->formValidation($request);
        try {
            $this->service->updateUser($request);
            return redirect()->route('users.index')->with('toast_success', 'User Updated Successfully');
        } catch (Exception $ex) {
            return redirect()->route('users.index')->with('toast_error', 'User Not Updated');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->service->deleteUser($id);
            return redirect()->route('users.index')->with('toast_success', 'User deleted successfully');
        } catch (Exception $ex) {
            return redirect()->route('users.index')->with('toast_error', 'User not deleted');
        }
    }


    /**
     * @return JsonResponse
     */
    public function checkEmail(): JsonResponse
    {
        $checkEmail = User::where('email', $_GET['email'])->first();
        if (!empty($checkEmail)) {
            return response()->json(['result' => "Email is already exist !"]);
        } else {
            return response()->json(['result' => ""]);
        }
    }


    /**
     * @return void
     */
    public function userInfoById()
    {
        $data['roles'] = DB::table('roles')->selectRaw('roles.id as id, roles.name as name')->get();
        $data['userRole'] = DB::table('roles')->leftjoin('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('model_has_roles.model_id', '=', $_GET['id'])->selectRaw('roles.id')->first();
       //dd($data['userRole']);
        $data['result'] = User::where('id', $_GET['id'])->first();
        echo json_encode($data);
    }


    /**
     * @param $request
     * @return void
     * @throws ValidationException
     */
    public function formValidation($request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required'
        ]);
    }
}

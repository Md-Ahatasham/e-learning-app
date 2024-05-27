<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        try {
            $data = $this->service->getUserInfo();
            $data['breadcrumb'] = $this->getBreadcrumb('User','User list');
        } catch (Exception $ex){
            $data = [];
        }

        return view('admin_level.users.index', with(['data' => $data]));
    }

    public function create()
    {
        $data = $this->service->preDefinedInfo();
        $data['breadcrumb'] = $this->getBreadcrumb('User','Add User');
        return view('admin_level.users.create', with(['data' => $data]));
    }


    /**
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        try {
            $this->service->storeUser($request);
            return redirect()->route('users.index')->with('toast_success', 'User created successfully');
        } catch (Exception $ex){
            return redirect()->route('users.index')->with('toast_error', 'Ops! Something went wrong.');
        }

    }

    public function edit(int $id)
    {
        $data = $this->service->preDefinedInfo();
        $data['userDetails'] = $this->service->getUserDetailsById($id);
        $data['breadcrumb'] = $this->getBreadcrumb("Users", "Update User");
        return view('admin_level.users.edit', with(['data' => $data]));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $this->service->updateUser($request,$id);
            return redirect()->route('users.index')->with('toast_success', 'User updated successfully');
        } catch (Exception $ex) {
            return redirect()->route('users.index')->with('toast_error', 'Ops! Something went wrong.');
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
            return redirect()->route('users.index')->with('toast_error', 'Ops! Something went wrong.');
        }
    }


    /**
     * @return JsonResponse
     */
    public function checkEmail(): JsonResponse
    {
        $result = $this->service->checkEmail($_GET['email']);
        return response()->json(['result' => $result]);
    }


    /**
     * @return void
     */
    public function userInfoById()
    {
        $data = $this->service->getUserDetailsById($_GET['id']);
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

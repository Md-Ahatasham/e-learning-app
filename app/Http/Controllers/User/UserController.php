<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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


    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->formValidation($request);
        try {
            $this->service->storeUser($request);
            return redirect()->route('users.index')->with('toast_success', 'User created successfully');
        } catch (Exception $ex){
            return redirect()->route('users.index')->with('toast_error', 'Ops! Something went wrong.');
        }

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
            $this->service->updateUser($request,$_GET['id']);
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

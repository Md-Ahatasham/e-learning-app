<?php
namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserRepository implements UserInterface{

    public function getAllUser()
    {
        return User::with('roles')->orderBy('id', 'DESC')->get();
    }

    public function getUserRoleName()
    {
        return Auth::user()->roles->pluck('name', 'name')->first();
    }

    public function getAllRoles()
    {
        return Role::pluck('name', 'id')->all();
    }


    public function storeUser($request)
    {
        return User::create($request);
    }

    public function getUserById($id)
    {
        return User::where('id', $id)->first();
    }

    public function updateUser($userInfo,$request)
    {
        return $userInfo->update($request->except(['_token', '_method', 'submit', 'user_photo', 'name']));
    }

    public function deleteUser($id)
    {
        return User::where('id', $id)->delete();
    }

    public function getUserDetailsById($id): array
    {
        $data['roles'] = DB::table('roles')->selectRaw('roles.id as id, roles.name as name')->get();
        $data['result'] = $this->getUserById($id);
        return $data;
    }

    /**
     * @param $email
     * @return mixed
     */
    public function checkEmail($email)
    {
        return User::where('email', $email)->first();
    }
}

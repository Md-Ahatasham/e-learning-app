<?php
namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserRepository implements UserInterface{

    public function getAllUser()
    {
        return User::with('roles')->where('role_id', 1)->orderBy('id', 'DESC')->get();
    }

    public function getUserRoleName()
    {
        return Auth::user()->roles->pluck('name', 'name')->first();
    }

    public function getAllRoles()
    {
        return Role::pluck('name', 'name')->all();
    }

    public function storeUser($request){
        return User::create($request);
    }

    public function getUserById($id){
        return User::where('id', $id)->first();
    }

    public function updateUser($userInfo,$request){
        return $userInfo->update($request->except(['_token', 'roles', '_method', 'submit', 'user_photo', 'name']));
    }

    public function deleteUser($id){
        return User::where('id', $id)->delete();
    }
}

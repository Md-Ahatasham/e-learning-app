<?php
namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    public function storeUserDetails($request)
    {
        return UserDetail::create($request);
    }

    public function getUserById($id)
    {
        return User::with('userDetail')->where('id', $id)->first();
    }

    public function updateUser($request, $userInfo)
    {
        return $userInfo->update($request);
    }

    public function deleteUser($id)
    {
        return User::where('id', $id)->delete();
    }

    public function getUserDetailsById($id)
    {
        return $this->getUserById($id);
    }

    public function getRoles(): Collection
    {
        return DB::table('roles')->selectRaw('roles.id as id, roles.name as name')->get();
    }

    /**
     * @param $email
     * @return mixed
     */
    public function checkEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function updateUserDetails($preparedEducationalRequest,$userId)
    {
      return UserDetail::updateOrCreate(['user_id'=>$userId], $preparedEducationalRequest);
    }

    public function updatePassword($password)
    {
      return User::find(Auth::user()->id)->update(['password' => Hash::make($password)]);
    }
}

<?php
namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserService extends Controller {
    protected $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function getUserInfo(): array
    {
        $data['users'] = $this->userRepository->getAllUser();
        //$data['userRole'] = $this->userRepository->getUserRoleName();
        $data['allRoles'] = $this->userRepository->getAllRoles();
        return $data;
    }

    public function storeUser($request){

        $request->merge(['profile_photo' => $this->uploadImage($request)]);
        $request['password'] = Hash::make($request['password']);
        $user = $this->userRepository->storeUser($request->all());
        $user->assignRole($request->input('roles'));
    }

    public function uploadImage($request,$userInfo=null){
        $image_url = asset('dist/img/default_avatar.png');
        if ($request->hasFile('user_photo')) {
            $image_url = $this->uploadUserPhoto($request->user_photo, !empty($userInfo) ? $userInfo->profile_photo : '');
        }
        return $image_url;
    }

    public function updateUser($request){
        $userInfo = $this->userRepository->getUserById($_GET['id']);
        $image_url = $this->uploadImage($request, $userInfo);

        if (!empty($image_url)) {
            $request->merge(['profile_photo' => $image_url]);
        }
        $this->userRepository->updateUser($userInfo,$request);
        DB::table('model_has_roles')->where('model_id', $_GET['id'])->delete();
        $userInfo->assignRole($request->input('roles'));
    }

    public function deleteUser($id){
        return $this->userRepository->deleteUser($id);
    }
}

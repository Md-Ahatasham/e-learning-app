<?php
namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
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
        $data['allRoles'] = $this->userRepository->getAllRoles();
        return $data;
    }

    public function storeUser($request){
        $request->merge(['profile_photo' => $this->uploadImage($request)]);
        $request['password'] = Hash::make($request['password']);
        $user = $this->userRepository->storeUser($request->all());
        $user->assignRole($request->input('role_id'));
    }

    public function uploadImage($request,$userInfo=null){
        $image_url = asset('dist/img/default_avatar.png');
        if ($request->hasFile('user_photo')) {
            $image_url = $this->uploadUserPhoto($request->user_photo, !empty($userInfo) ? $userInfo->profile_photo : '');
        }
        return $image_url;
    }

    public function updateUser($request,$id): bool
    {
        try {
            $userInfo = $this->userRepository->getUserById($id);
            $image_url = $this->uploadImage($request, $userInfo);

            if (!empty($image_url)) {
                $request->merge(['profile_photo' => $image_url]);
            }
            $this->userRepository->updateUser($userInfo,$request);
            //DB::table('model_has_roles')->where('model_id', $id)->delete();
            $userInfo->assignRole($request->input('role_id'));
            return true;
        } catch (Exception $ex){
            return false;
        }

    }

    public function deleteUser($id){
        return $this->userRepository->deleteUser($id);
    }

    public function getUserDetailsById($id): array
    {
        return $this->userRepository->getUserDetailsById($id);
    }

    public function checkEmail($email): string
    {
        $data = $this->userRepository->checkEmail($email);
        if(empty($data)){
            return "Email is already exist !";
        }
        return "";
    }
}

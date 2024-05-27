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
        $userRequest = $this->prepareUserRequest($request);
        $userInfo = $this->userRepository->storeUser($userRequest);
        if(!empty($userInfo))
        {
            $userInfo->assignRole($request->input('role_id'));
            $preparedEducationalRequest = $this->prepareEducationalQualificationRequest($request, $userInfo->id);
            $this->userRepository->storeUserDetails($preparedEducationalRequest);
        }

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
            $userRequest = $this->prepareUserRequest($request,$fromUpdate = true);
            $updateInfo = $this->userRepository->updateUser($userRequest, $userInfo);
            if($updateInfo)
            {
                $userInfo->assignRole($request->input('role_id'));
                $preparedEducationalRequest = $this->prepareEducationalQualificationRequest($request, $userInfo->id);
                $this->userRepository->updateUserDetails($preparedEducationalRequest,$userInfo->id);
            }
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
        $educationalQualification = [];
        $data['roles'] = $this->userRepository->getRoles();
        $data['result'] = $this->userRepository->getUserDetailsById($id);
        if(!empty($data['result']['userDetail']))
        {
           $educationalQualification =  json_decode($data['result']['userDetail']['educational_qualification'],true);
           $educationalQualification['id'] =  $data['result']['userDetail']['id'];
        }
        $data['educationalQualification'] = $educationalQualification;
        return $data;
    }

    public function checkEmail($email): string
    {
        $data = $this->userRepository->checkEmail($email);
        if(empty($data)){
            return "Email is already exist !";
        }
        return "";
    }

    public function preDefinedInfo(): array
    {
        $data['allRoles'] = $this->userRepository->getAllRoles();
        $data['degrees'] = $this->educationalQualification();
        $data['boards'] = $this->board();
        return $data;
    }

    public function prepareUserRequest($request, $fromUpdate = false): array
    {
        $preparedRequest = [];
        $preparedRequest['first_name'] = $request['first_name'];
        $preparedRequest['last_name'] = $request['last_name'];
        $preparedRequest['role_id'] = $request['role_id'];
        $preparedRequest['email'] = $request['email'];
        $preparedRequest['profile_photo'] = $this->uploadImage($request);
        if(!$fromUpdate)
            {
                $preparedRequest['password'] = Hash::make($request['password']);
                $preparedRequest['user_code'] = rand();
            }

        $preparedRequest['status'] = 1;
        $preparedRequest['speciality'] = $request['speciality'] ?? "";
        $preparedRequest['experience'] = $request['experience'] ?? null;
        return $preparedRequest;
    }

    public function prepareEducationalQualificationRequest($request, $userId): array
    {
        $preparedEducationalRequest = [];
        $prepareRequestData = [];
        $preparedEducationalRequest['ssc_org_name'] = $request['ssc_org_name'] ?? '';
        $preparedEducationalRequest['ssc_gpa'] = $request['ssc_gpa'] ?? '';
        $preparedEducationalRequest['ssc_passing_year'] = $request['ssc_passing_year'];
        $preparedEducationalRequest['ssc_board'] =$request['ssc_board_name'] ?? '';
        $preparedEducationalRequest['ssc_degree'] =$request['ssc_degree_name'] ?? '';
        $preparedEducationalRequest['ssc_certificate'] = !empty($request['ssc_certificate']) ? $this->uploadCertificate($request['ssc_certificate'], "ssc_certificate"): "" ;

        $preparedEducationalRequest['hsc_org_name'] = $request['hsc_org_name'] ?? '';
        $preparedEducationalRequest['hsc_gpa'] = $request['hsc_gpa'] ?? '';
        $preparedEducationalRequest['hsc_passing_year'] = $request['hsc_passing_year'];
        $preparedEducationalRequest['hsc_board'] =$request['hsc_board_name'] ?? '';
        $preparedEducationalRequest['hsc_degree'] =$request['hsc_degree_name'] ?? '';
        $preparedEducationalRequest['hsc_certificate'] = !empty($request['hsc_certificate']) ? $this->uploadCertificate($request['hsc_certificate'], "hsc_certificate"): "" ;

        $preparedEducationalRequest['honors_org_name'] = $request['honors_org_name'] ?? '';
        $preparedEducationalRequest['honors_gpa'] = $request['honors_gpa'] ?? '';
        $preparedEducationalRequest['honors_passing_year'] = $request['honors_passing_year'];
        $preparedEducationalRequest['honors_board'] =$request['honors_board_name'] ?? '';
        $preparedEducationalRequest['honors_degree'] =$request['honors_degree_name'] ?? '';
        $preparedEducationalRequest['honors_certificate'] = !empty($request['honors_certificate']) ? $this->uploadCertificate($request['honors_certificate'], "honors_certificate"): "" ;

        $preparedEducationalRequest['masters_org_name'] = $request['masters_org_name'] ?? '';
        $preparedEducationalRequest['masters_gpa'] = $request['masters_gpa'] ?? '';
        $preparedEducationalRequest['masters_passing_year'] = $request['masters_passing_year'];
        $preparedEducationalRequest['masters_board'] =$request['masters_board_name'] ?? '';
        $preparedEducationalRequest['masters_degree'] =$request['masters_degree_name'] ?? '';
        $preparedEducationalRequest['masters_certificate'] = !empty($request['masters_certificate']) ? $this->uploadCertificate($request['masters_certificate'], "masters_certificate"): "" ;

        $prepareRequestData['user_id'] = $userId;
        $prepareRequestData['educational_qualification'] = json_encode($preparedEducationalRequest);

        return $prepareRequestData;
    }
}

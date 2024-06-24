<?php
namespace App\Services\Routine;

use App\Http\Controllers\Controller;
use App\Repositories\Routine\RoutineRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RoutineService extends Controller {
    protected $repository;

    public function __construct(RoutineRepository $repository){
        $this->repository = $repository;
    }

    public function getAllRoutine()
    {
        return $this->repository->getAllRoutine();
    }

    public function getRoutineById($id)
    {
        return $this->repository->getRoutineById($id);
    }


    public function storeRoutine($request)
    {
        try {
            return $this->repository->storeRoutine($request);
        } catch (\Exception $ex){
            return $ex->getMessage();
        }
    }

    public function updateRoutine($request, $id)
    {
        return $this->repository->updateRoutine($request,$id);
    }

    public function deleteRoutine($id): int
    {
        return $this->repository->deleteRoutine($id);
    }

    public function getAllRoutineByUserId($userId)
    {
        return app()->make(UserRepository::class)->getUserSpecificAllRoutine($userId);
    }

}

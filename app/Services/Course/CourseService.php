<?php
namespace App\Services\Course;

use App\Http\Controllers\Controller;
use App\Repositories\Course\CourseRepository;

class CourseService extends Controller {
    protected $repository;

    public function __construct(CourseRepository $repository){
        $this->repository = $repository;
    }

    public function getAllCourse()
    {
        return $this->repository->getAllCourse();
    }

    public function getCourseById($id)
    {
        return $this->repository->getCourseById($id);
    }

    /**
     * @param $request
     * @return null
     */
    public function storeCourse($request)
    {
        return $this->repository->storeCourse($request);
    }

    public function updateCourse($request, $id)
    {
        return $this->repository->updateCourse($request,$id);
    }

    public function deleteCourse($id)
    {
        return $this->repository->deleteCourse($id);
    }


}

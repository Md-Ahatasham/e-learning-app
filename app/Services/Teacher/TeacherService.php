<?php
namespace App\Services\Teacher;

use App\Http\Controllers\Controller;
use App\Repositories\Teacher\TeacherRepository;

class TeacherService extends Controller {
    protected $repository;

    public function __construct(TeacherRepository $repository){
        $this->repository = $repository;
    }

    public function getAllTeacherList()
    {
        return $this->repository->getAllTeacherList();
    }

    public function assignCourseToTeacher($request)
    {
        return $this->repository->assignCourseToTeacher($request);
    }

}

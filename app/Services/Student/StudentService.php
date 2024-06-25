<?php
namespace App\Services\Student;

use App\Http\Controllers\Controller;
use App\Repositories\Student\StudentRepository;

class StudentService extends Controller {
    protected $repository;

    public function __construct(StudentRepository $repository){
        $this->repository = $repository;
    }

    public function getAllStudentList()
    {
        return $this->repository->getAllStudentList();
    }

    public function assignCourseToStudent($request): bool
    {
        return $this->repository->assignCourseToStudent($request);
    }

}

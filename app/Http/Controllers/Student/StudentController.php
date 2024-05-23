<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\Student\StudentService;

class StudentController extends Controller
{
    protected $service;

    public function __construct(StudentService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data['breadcrumb'] = $this->getBreadcrumb("Students", "Student List");
        return view('admin_level.students.index', with(['data' => $data]));
    }


    /**
     * Display datatable student list.
     * @date: 15-03-2022
     */

    public function dataTableStudentList()
    {
        return $this->service->getAllStudentList();
    }

}

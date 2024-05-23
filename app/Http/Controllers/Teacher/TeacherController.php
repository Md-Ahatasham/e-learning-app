<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Services\Teacher\TeacherService;


class TeacherController extends Controller
{
    protected $service;

    public function __construct(TeacherService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data['breadcrumb'] = $this->getBreadcrumb("Teachers", "Teacher List");
        return view('admin_level.teachers.index', with(['data' => $data]));
    }


    /**
     * Display datatable teacher list.
     * @date: 15-03-2022
     */

    public function dataTableTeacherList()
    {
        return $this->service->getAllTeacherList();
    }

}

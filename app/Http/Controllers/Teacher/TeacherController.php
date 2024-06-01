<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Course\CourseService;
use App\Services\Teacher\TeacherService;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class TeacherController extends Controller
{
    protected $service;

    public function __construct(TeacherService $service)
    {
        $this->service = $service;
    }

    /**
     * @throws BindingResolutionException
     */
    public function index()
    {
        $data['teacherList'] = $this->service->getAllTeacherList();
        $data['courseList'] = app()->make(CourseService::class)->getAllCourse();
        $data['breadcrumb'] = $this->getBreadcrumb("Teachers", "Teacher List");
//        dd($data);
        return view('admin_level.teachers.index', with(['data' => $data]));
    }

    public function assignCourse(Request $request): RedirectResponse
    {
        try {
            $this->service->assignCourseToTeacher($request->all());
            return redirect()->route('teachers.index')->with('toast_success', 'Assigned courses successfully');
        } catch (Exception $ex){
            return redirect()->route('teachers.index')->with('toast_error', 'Ops! Something went wrong.');
        }

    }


}

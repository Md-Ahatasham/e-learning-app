<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Batch\BatchService;
use App\Services\Course\CourseService;
use App\Services\Student\StudentService;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    protected $service;

    public function __construct(StudentService $service)
    {
        $this->service = $service;
    }

    /**
     * @throws BindingResolutionException
     */
    public function index()
    {
        $data['studentList'] = $this->service->getAllStudentList();
        $data['courseList'] = app()->make(CourseService::class)->getAllCourse();
        $data['batchList'] = app()->make(BatchService::class)->getAllBatch();
        $data['breadcrumb'] = $this->getBreadcrumb("Students", "Student List");
        return view('backend.students.index', with(['data' => $data]));
    }

    public function assignCourse(Request $request): RedirectResponse
    {
        try {
            $this->service->assignCourseToStudent($request->all());
            return redirect()->route('students.index')->with('toast_success', 'Assigned courses successfully');
        } catch (Exception $ex){
            return redirect()->route('students.index')->with('toast_error', 'Ops! Something went wrong.');
        }

    }


}

<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Services\Course\CourseService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    protected $service;

    public function __construct(CourseService $service)
    {
        $this->service = $service;
    }


    /**
     * Display a list of roles.
     * @date: 02-03-2022
     * @return Application|Factory|View
     */

    public function index()
    {
        $data['courseList'] = $this->service->getAllCourse();
        $data['courseWiseCount'] = $this->service->getCourseWiseCount();
        $data['breadcrumb'] = $this->getBreadcrumb("Course", "Course list");
        return view('backend.courses.index', with(['data' => $data]));
    }


    /**
     * Store a newly created permission to role.
     * @date: 02-03-2022
     * @param Request $request
     * @return RedirectResponse
     */

    public function store(Request $request): RedirectResponse
    {
        try {
            $this->service->storeCourse($request->all());
        } catch (Exception $ex) {
            return redirect()->route('courses.index')->with('toast_warning', 'Failed, Course not added!');
        }
        return redirect()->route('courses.index')->with('toast_success', 'Course added successfully !');

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */

    public function update(Request $request): RedirectResponse
    {
        try {
            $this->service->updateCourse($request, $_GET['id']);
            return redirect()->route('courses.index')->with('toast_success', 'Course updated successfully !');
        } catch (Exception $ex) {
            return redirect()->route('courses.index')->with('toast_error', 'Error Occured. Course not updated !');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            if ($this->service->deleteCourse($id)) {
                return redirect()->route('courses.index')->with('toast_success', 'Course deleted successfully!');
            }
        } catch (Exception $ex) {
            return redirect()->route('courses.index')->with('toast_error', 'Error! Course is not deleted');
        }

    }

    /**
     * Show the form for editing batch.
     */

    public function courseInfoById()
    {
        $data['result'] = $this->service->getCourseById($_GET['id']);
        return response()->json($data);
    }
}

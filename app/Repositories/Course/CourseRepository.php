<?php
namespace App\Repositories\Course;

use App\Interfaces\Course\CourseInterface;
use App\Models\Course;
use App\Models\TeacherStudentCourse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseRepository implements CourseInterface{

    public function getAllCourse()
    {
        if(Auth::user()->role_id !==1){
            return User::with('courses')->where('id',Auth::user()->id)->first();
        }
        return Course::all()->sortByDesc('id');
    }


    public function storeCourse($request)
    {
        return Course::create($request);
    }

    public function getCourseById($id)
    {
        return Course::find($id);
    }

    public function updateCourse($request,$id)
    {
        return Course::find($id)->update($request->all());
    }

    public function deleteCourse($id): int
    {
        return Course::destroy($id);
    }

    public function getCourseWiseCount()
    {
        return TeacherStudentCourse::select(
                'courses.*',
                DB::raw('COUNT(DISTINCT contents.id) AS contents_count'),
                DB::raw('COUNT(DISTINCT batch_id) AS batch_count'),
                DB::raw('COUNT(DISTINCT CASE WHEN users.role_id = 3 THEN user_id END) AS user_count'),
                DB::raw('COUNT(DISTINCT CASE WHEN users.role_id = 2 THEN user_id END) AS teacher_count'),

            )
            ->join('users', 'user_course.user_id', '=', 'users.id')
            ->join('courses', 'user_course.course_id', '=', 'courses.id')
            ->join('contents', 'user_course.course_id', '=', 'contents.course_id')
            ->groupBy('user_course.course_id')
            ->get();
    }



}

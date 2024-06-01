<?php
namespace App\Repositories\Course;

use App\Interfaces\Course\CourseInterface;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

}

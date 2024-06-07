<?php
namespace App\Repositories\Teacher;

use App\Interfaces\Teacher\TeacherInterface;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TeacherRepository implements TeacherInterface{

    public function getAllTeacherList()
    {
        return User::with(['courses','batches'])->where('role_id', 2)->get();
    }

    public function assignCourseToTeacher($request): bool
    {
        $user = User::find($request['user_id']);
//        $user->courses()->attach($request['course_id']);
       // $request['course_id'] = 7;
        try{
            foreach($request['course_id'] as $key=>$course){
                $user->courses()->attach($course, ['batch_id' => $request['batch_id'][$key]]);
            }

        } catch(\Exception $ex){
            dd($ex->getMessage(), $ex->getFile(),$ex->getLine());
        }


        return true;
    }
}

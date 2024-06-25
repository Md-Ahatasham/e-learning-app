<?php
namespace App\Repositories\Student;

use App\Interfaces\Student\StudentInterface;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StudentRepository implements StudentInterface{

    public function getAllStudentList()
    {
        return User::with(['courses','batches'])->where('role_id', 3)->get();
    }

    public function assignCourseToStudent($request): bool
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

<?php
namespace App\Repositories\Student;

use App\Interfaces\Student\StudentInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StudentRepository implements StudentInterface{

    public function getAllStudentList(): Collection
    {
       return DB::table('users')
            ->leftjoin('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.name', '=', 'Student')
            ->selectRaw('users.*')
            ->get();
    }
}

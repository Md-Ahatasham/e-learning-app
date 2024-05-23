<?php
namespace App\Repositories\Teacher;

use App\Interfaces\Teacher\TeacherInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TeacherRepository implements TeacherInterface{

    public function getAllTeacherList(): Collection
    {
        return DB::table('users')
            ->leftjoin('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.name', '=', 'Teacher')
            ->selectRaw('users.*')
            ->get();
    }
}

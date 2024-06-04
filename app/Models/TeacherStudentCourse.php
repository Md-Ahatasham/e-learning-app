<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TeacherStudentCourse extends Pivot
{
    protected $table = 'user_course';


}

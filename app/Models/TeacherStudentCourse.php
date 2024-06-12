<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TeacherStudentCourse extends Pivot
{
    protected $table = 'user_course';

// Define the relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship to course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Define the relationship to batch
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}

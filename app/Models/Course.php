<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_course')
            ->using(TeacherStudentCourse::class)
            ->withTimestamps()
            ->withPivot('batch_id');
    }

    public function routines(): HasMany
    {
        return $this->hasMany(Routine::class, 'course_id','id');
    }
}

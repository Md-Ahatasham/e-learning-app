<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Batch extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function routines(): HasMany
    {
        return $this->hasMany(Routine::class, 'batch_id','id');
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'user_course')
            ->withPivot('user_id', 'created_at', 'updated_at');
    }

    // Define the relationship to users through the user_course pivot table
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_course', 'batch_id', 'user_id')
            ->withPivot('course_id');
    }
}

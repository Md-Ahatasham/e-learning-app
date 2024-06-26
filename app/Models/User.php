<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [''];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function userDetail(): HasOne
    {
        return $this->hasOne('App\Models\UserDetail', 'user_id', 'id');
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'user_course')
            ->using(TeacherStudentCourse::class)
            ->withTimestamps()
            ->withPivot('batch_id');
    }

    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'user_course')
            ->withPivot('course_id', 'created_at', 'updated_at');
    }

    public function routines(): HasManyThrough
    {
        return $this->hasManyThrough(Routine::class, TeacherStudentCourse::class, 'user_id', 'course_id', 'id', 'course_id');
    }
}

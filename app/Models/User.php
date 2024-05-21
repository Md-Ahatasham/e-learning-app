<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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


    public function userDetail()
    {
        return $this->hasOne('App\Models\UserDetail', 'user_id', 'id');
    }

    public function rounderInfo()
    {
        return $this->hasOne('App\Models\Rounder', 'user_id', 'id');
    }

    public function patient()
    {
        return $this->hasMany('App\Models\Patient', 'assigned_rounder_id', 'id');
    }
    public function roundingHistory()
    {
        return $this->hasMany('App\Models\RoundingHistory', 'rounder_id', 'id');
    }

    public function patientAdmittedBy()
    {
        return $this->hasMany('App\Models\Patient', 'entry', 'id');
    }
    public function userAsEntryBy()
    {
        return $this->hasMany('App\Models\PatientActivityLog', 'entry_by', 'id');
    }
    public function tablet()
    {
        return $this->hasMany('App\Models\Tablet', 'rounder_id', 'id');
    }
    public function roundingActivityLogUser()
    {
        return $this->hasMany('App\Models\RounderActivityLog', 'entry_by', 'id');
    }
    function notification()
    {
        return $this->hasMany('App\Models\Notification', 'rounder_id', 'id');
    }
    public function latestActivity()
    {
        return $this->hasOne('App\Models\RounderActivityLog', 'rounder_id', 'id')->OrderBy('id','DESC');
    }
    
}

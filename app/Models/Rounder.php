<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rounder extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [''];

    public function userInfo()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function education()
    {
        return $this->hasMany('App\Models\RounderQualification');
    }
    public function specialty()
    {
        return $this->hasMany('App\Models\RounderSpeciality');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id', 'user_id');
    }
    public function rounderHistory()
    {
        return $this->belongsTo('App\Models\RoundingHistory', 'rounder_id', 'user_id');
    }
    public function tabInfo()
    {
        return $this->belongsTo('App\Models\Patient', 'user_id', 'assigned_rounder_id');
    }
    
}

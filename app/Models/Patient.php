<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [''];

    function rooms()
    {
        return $this->belongsTo('App\Models\Room','room','id');
    }
    function units()
    {
        return $this->belongsTo('App\Models\Unit','unit','id');
    }
    function beds()
    {
        return $this->belongsTo('App\Models\Bed','bed','id');
    }
    function userAsRounder()
    {
        return $this->belongsTo('App\Models\User', 'assigned_rounder_id', 'id');
    }

    function preCaution()
    {
        return $this->hasMany('App\Models\PatientPreCaution', 'patient_id', 'id');
    }

    function userAsEntryBy()
    {
        return $this->belongsTo('App\Models\User', 'entry_by', 'id');
    }

    function inOutHistory()
    {
        return $this->hasMany('App\Models\PatientInOutHistory', 'patient_id', 'id');
    }
    function roundingHistory()
    {
        return $this->hasMany('App\Models\RoundingHistory', 'patient_id', 'id');
    }
    function notification()
    {
        return $this->hasMany('App\Models\Notification', 'patient_id', 'id');
    }
    function rounderInfo()
    {
        return $this->hasOne('App\Models\Rounder', 'user_id', 'assigned_rounder_id');
    }
}

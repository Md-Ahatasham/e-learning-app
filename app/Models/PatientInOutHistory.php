<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientInOutHistory extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [''];

    function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'patient_id', 'id');
    }
}

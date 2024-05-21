<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoundingHistory extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [''];

    function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'patient_id', 'id');
    }
    function rounder()
    {
        return $this->belongsTo('App\Models\User', 'rounder_id', 'id');
    }
    function rounderInfo()
    {
        return $this->belongsTo('App\Models\Rounder', 'rounder_id', 'user_id');
    }
}

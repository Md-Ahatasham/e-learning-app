<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientPreCaution extends Model
{
    use HasFactory;
    protected $guarded = [''];
    
    function patient(){
    	return $this->belongsTo('App\Models\Patient','patient_id','id');
    }

    function precaution(){
    	return $this->belongsTo('App\Models\PreCaution','pre_caution_id','id');
    }
}

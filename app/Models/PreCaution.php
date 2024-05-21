<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreCaution extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [''];
    
    public function patientPreCaution(){
        return $this->hasMany('App\Models\PatientPreCaution','pre_caution_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientTransferHistory extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [''];
    
    function patient(){
    	return $this->belongsTo('App\Models\Patient');
    }
    function userAsPreviousRounder(){
    	return $this->belongsTo('App\Models\User','previous_rounder_id','id');
    }

    function userAsCurrentRounder(){
    	return $this->belongsTo('App\Models\User','current_rounder_id','id');
    }
    function userAsEntryBy(){
    	return $this->belongsTo('App\Models\User','entry_by','id');
    }
}

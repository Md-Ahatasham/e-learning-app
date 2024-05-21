<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    use HasFactory;
    protected $guarded = [''];
    function room(){
    	return $this->belongsTo('App\Models\Room');
    }
    public function patient(){
        return $this->hasMany('App\Models\Patient','bed','id');
    }
}

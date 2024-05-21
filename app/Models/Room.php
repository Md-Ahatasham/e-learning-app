<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = [''];

    function unit(){
    	return $this->belongsTo('App\Models\Unit');
    }
    public function bed(){
        return $this->hasMany('App\Models\Bed');
    }

    public function patient(){
        return $this->hasMany('App\Models\Patient','room','id');
    }
}

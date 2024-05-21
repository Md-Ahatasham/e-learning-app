<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [''];

    public function room(){
        return $this->hasMany('App\Models\Room');
    }
    public function patient(){
        return $this->hasMany('App\Models\Patient','unit','id');
    }
}

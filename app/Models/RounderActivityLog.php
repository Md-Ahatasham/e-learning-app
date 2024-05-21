<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RounderActivityLog extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [''];
    function userAsEntryBy()
    {
        return $this->belongsTo('App\Models\User', 'entry_by', 'id');
    }
    public function rounder()
    {
        return $this->belongsTo('App\Models\Rounder', 'rounder_id', 'id');
    }
}

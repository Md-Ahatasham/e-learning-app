<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function rounder()
    {
        return $this->belongsTo('App\Models\User', 'rounder_id', 'id');
    }
    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'patient_id', 'id');
    }
}

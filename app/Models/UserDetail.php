<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}

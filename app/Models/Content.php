<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Content extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function courses(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'course_id', 'id');
    }
}

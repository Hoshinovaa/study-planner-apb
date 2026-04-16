<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'deadline',
        'status',
        'user_id',
        'subject_id'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
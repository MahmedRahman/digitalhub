<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'lesson_id',
        'status',
        'completed_at',
        'progress',
        'last_position',
        'notes'
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'progress' => 'integer',
        'last_position' => 'integer'
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}

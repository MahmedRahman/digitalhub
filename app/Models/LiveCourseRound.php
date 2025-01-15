<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveCourseRound extends Model
{
    protected $fillable = [
        'livecourse_id',
        'instructor_id',
        'round_name',
        'start_date',
        'end_date',
        'hours_count',
        'price',
        'notes',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'price' => 'decimal:2'
    ];

    public function livecourse()
    {
        return $this->belongsTo(LiveCourse::class, 'livecourse_id');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}

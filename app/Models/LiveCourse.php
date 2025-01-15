<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LiveCourseRound;
use App\Models\RoundEnrollment;

class LiveCourse extends Model
{
    protected $table = 'livecourses';

    protected $fillable = [
        'name',
        'description',
        'objectives',
        'video_url',
        'status'
    ];

    public function rounds()
    {
        return $this->hasMany(LiveCourseRound::class, 'livecourse_id');
    }

    public function enrollments()
    {
        return $this->hasManyThrough(RoundEnrollment::class, LiveCourseRound::class, 'livecourse_id', 'live_course_round_id');
    }
}

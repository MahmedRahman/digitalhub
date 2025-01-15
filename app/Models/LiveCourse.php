<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LiveCourseRound;

class LiveCourse extends Model
{
    protected $table = 'livecourses';
    
    protected $fillable = [
        'name',
        'description',
        'objectives',
        'video_url',
        'material_url',
        'powerpoint_url',
    ];

    public function rounds()
    {
        return $this->hasMany(LiveCourseRound::class, 'livecourse_id');
    }
}

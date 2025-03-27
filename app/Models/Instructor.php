<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'title',
        'bio',
        'profile_photo_path',
        'facebook',
        'twitter',
        'linkedin',
        'website',
        'experience',
        'status',
        'specialization_id'
    ];

    protected $appends = [
        'profile_photo_url',
        'status_label'
    ];

    // Define status constants
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public static function getStatusOptions()
    {
        return [
            self::STATUS_ACTIVE => 'نشط',
            self::STATUS_INACTIVE => 'غير نشط'
        ];
    }

    public function getStatusLabelAttribute()
    {
        return self::getStatusOptions()[$this->status] ?? 'غير معروف';
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class, 'instructor_specialization');
    }

    /**
     * Get the courses for the instructor.
     * This uses the many-to-many relationship through the instructor_course pivot table
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            return Storage::url($this->profile_photo_path);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

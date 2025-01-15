<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\RoundEnrollment;
use App\Models\StudentPayment;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'type',
        'profile_photo_path'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get the courses that the user is enrolled in.
     */
    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')
                    ->withTimestamps()
                    ->withPivot('status', 'progress', 'completed_at');
    }

    public function roundEnrollments()
    {
        return $this->hasMany(RoundEnrollment::class);
    }

    /**
     * علاقة مع المدفوعات
     */
    public function payments()
    {
        return $this->hasMany(StudentPayment::class);
    }

    /**
     * علاقة مع الجولات التي سجل فيها الطالب
     */
    public function rounds()
    {
        return $this->belongsToMany(LiveCourseRound::class, 'live_course_round_student')
                    ->withPivot('payment_status', 'total_amount', 'paid_amount', 'remaining_amount', 'payment_notes')
                    ->withTimestamps();
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isInstructor()
    {
        return $this->role === 'instructor';
    }
}

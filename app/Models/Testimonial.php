<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_name',
        'comment',
        'rating',
        'display_location',
        'course_id',
        'is_active',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean',
    ];
    
    /**
     * Get the course that this testimonial belongs to (if any).
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    /**
     * Scope a query to only include active testimonials.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    /**
     * Scope a query to only include testimonials for the home page.
     */
    public function scopeForHome($query)
    {
        return $query->where(function($q) {
            $q->where('display_location', 'home')
              ->orWhere('display_location', 'both');
        });
    }
    
    /**
     * Scope a query to only include testimonials for a specific course.
     */
    public function scopeForCourse($query, $courseId)
    {
        return $query->where(function($q) use ($courseId) {
            $q->where(function($inner) {
                $inner->where('display_location', 'course')
                      ->orWhere('display_location', 'both');
              })
              ->where('course_id', $courseId);
        });
    }
}

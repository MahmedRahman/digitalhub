<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Default course image URL
     */
    const DEFAULT_IMAGE = 'images/courses/default.jpg';

    /**
     * Course status constants
     */
    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_ARCHIVED = 'archived';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'duration_in_weeks',
        'lectures_count',
        'level',
        'language',
        'image',
        'promotional_video',
        'status',
        'category_id',
        'instructor_id',
        'requirements',
        'what_you_will_learn'
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    protected $appends = ['image_url'];

    /**
     * Get available status options
     */
    public static function getStatusOptions(): array
    {
        return [
            self::STATUS_DRAFT => 'مسودة',
            self::STATUS_PUBLISHED => 'منشور',
            self::STATUS_ARCHIVED => 'مؤرشف'
        ];
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return self::getStatusOptions()[$this->status] ?? $this->status;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset(self::DEFAULT_IMAGE);
        }

        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        // Check if image starts with http or https
        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        // If image starts with storage/, remove it as asset() will add the correct path
        $imagePath = str_replace('storage/', '', $this->image);
        
        return asset('storage/' . $imagePath);
    }

    public function setImageAttribute($value)
    {
        if ($value && !filter_var($value, FILTER_VALIDATE_URL) && !str_starts_with($value, 'http')) {
            // If a file is uploaded, store it in the public disk
            if (is_file($value)) {
                $this->attributes['image'] = Storage::disk('public')->put('courses', $value);
            } else {
                $this->attributes['image'] = $value;
            }
        } else {
            $this->attributes['image'] = $value;
        }
    }

    /**
     * Get the lessons for the course.
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }

    public function enrollment()
    {
        return $this->hasOne(Enrollment::class)->where('user_id', auth()->id());
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user')
            ->withPivot('progress', 'completed_at')
            ->withTimestamps();
    }
}

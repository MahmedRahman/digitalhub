<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\Category;
use App\Models\HeroSection;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $heroSections = HeroSection::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $latestCourses = Course::with(['category', 'instructor', 'instructors'])
            ->where('status', Course::STATUS_PUBLISHED)
            ->latest()
            ->take(6)
            ->get();

        $featuredInstructors = Instructor::withCount('courses')
            ->orderBy('courses_count', 'desc')
            ->take(6)
            ->get();

        $categories = Category::withCount('courses')
            ->orderBy('courses_count', 'desc')
            ->take(8)
            ->get();


        // Load testimonials for home page
        $testimonials = Testimonial::active()->forHome()->latest()->take(6)->get();


        return view('welcome', compact('heroSections', 'latestCourses', 'featuredInstructors', 'categories', 'testimonials'));
    }
}

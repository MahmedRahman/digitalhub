<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\Course;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display testimonials for the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function homeTestimonials()
    {
        $testimonials = Testimonial::active()->forHome()->latest()->take(6)->get();
        return view('partials.home-testimonials', compact('testimonials'));
    }

    /**
     * Display testimonials for a specific course.
     *
     * @param  int  $courseId
     * @return \Illuminate\Http\Response
     */
    public function courseTestimonials($courseId)
    {
        $testimonials = Testimonial::active()->forCourse($courseId)->latest()->get();
        return view('partials.course-testimonials', compact('testimonials'));
    }

    /**
     * Submit a new testimonial (for logged in users).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for submitting a new testimonial.
     *
     * @param  int|null  $courseId
     * @return \Illuminate\Http\Response
     */
    public function showSubmitForm($courseId = null)
    {
        $course = null;
        if ($courseId) {
            $course = Course::findOrFail($courseId);
        }
        
        return view('testimonials.submit', compact('course'));
    }

    /**
     * Submit a new testimonial (for any user).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'course_id' => 'nullable|exists:courses,id',
            'display_location' => 'required|in:home,course,both',
        ]);

        // Create the testimonial (inactive by default, needs admin approval)
        $testimonial = Testimonial::create([
            'client_name' => $request->client_name,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'display_location' => $request->display_location,
            'course_id' => $request->course_id,
            'is_active' => false, // Requires admin approval
        ]);

        return redirect()->back()->with('success', 'شكراً لمشاركة رأيك! سيتم مراجعته ونشره قريباً.');
    }
}

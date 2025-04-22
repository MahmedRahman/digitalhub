<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::with('course')->latest()->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        $displayLocations = [
            'home' => 'الصفحة الرئيسية فقط',
            'course' => 'صفحة الكورس فقط',
            'both' => 'الصفحة الرئيسية وصفحة الكورس'
        ];
        return view('admin.testimonials.create', compact('courses', 'displayLocations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_name' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'display_location' => 'required|in:home,course,both',
            'course_id' => 'nullable|exists:courses,id',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Ensure course_id is required when display_location is 'course' or 'both'
        if (in_array($request->display_location, ['course', 'both']) && empty($request->course_id)) {
            return redirect()->back()
                ->withErrors(['course_id' => 'يجب اختيار كورس عند اختيار عرض الرأي في صفحة الكورس'])
                ->withInput();
        }

        $testimonial = Testimonial::create([
            'client_name' => $request->client_name,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'display_location' => $request->display_location,
            'course_id' => $request->course_id,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'تم إضافة رأي العميل بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $testimonial = Testimonial::with('course')->findOrFail($id);
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $courses = Course::all();
        $displayLocations = [
            'home' => 'الصفحة الرئيسية فقط',
            'course' => 'صفحة الكورس فقط',
            'both' => 'الصفحة الرئيسية وصفحة الكورس'
        ];
        return view('admin.testimonials.edit', compact('testimonial', 'courses', 'displayLocations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'client_name' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'display_location' => 'required|in:home,course,both',
            'course_id' => 'nullable|exists:courses,id',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Ensure course_id is required when display_location is 'course' or 'both'
        if (in_array($request->display_location, ['course', 'both']) && empty($request->course_id)) {
            return redirect()->back()
                ->withErrors(['course_id' => 'يجب اختيار كورس عند اختيار عرض الرأي في صفحة الكورس'])
                ->withInput();
        }

        $testimonial->update([
            'client_name' => $request->client_name,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'display_location' => $request->display_location,
            'course_id' => $request->course_id,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'تم تحديث رأي العميل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'تم حذف رأي العميل بنجاح');
    }

    /**
     * Toggle the active status of the testimonial.
     */
    public function toggleStatus(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->is_active = !$testimonial->is_active;
        $testimonial->save();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'تم تغيير حالة رأي العميل بنجاح');
    }
}

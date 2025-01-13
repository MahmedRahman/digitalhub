<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query()
            ->with(['category', 'instructors'])
            ->latest();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('title', 'like', "%{$search}%");
        }

        $courses = $query->paginate(10);

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        $instructors = Instructor::where('status', true)->get();
        return view('admin.courses.create', compact('categories', 'instructors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'promotional_video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20480',
            'duration_in_weeks' => 'required|integer|min:1',
            'lectures_count' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'instructor_ids' => 'required|array|min:1',
            'instructor_ids.*' => 'exists:instructors,id',
            'status' => 'required|in:draft,published',
            'requirements' => 'nullable|string',
            'what_you_will_learn' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('courses/images', 'public');
        }

        if ($request->hasFile('promotional_video')) {
            $validated['promotional_video'] = $request->file('promotional_video')
                ->store('courses/videos', 'public');
        }

        $course = Course::create($validated);
        $course->instructors()->attach($request->instructor_ids);

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'تم إنشاء الدورة بنجاح');
    }

    public function show(Course $course)
    {
        $course->load(['category', 'instructors', 'lessons' => function ($query) {
            $query->orderBy('order');
        }]);
        
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
   
        $categories = Category::all();
        $instructors = Instructor::where('status', true)->get();
        $selectedInstructors = $course->instructors->pluck('id')->toArray();
        return view('admin.courses.edit', compact('course', 'categories', 'instructors', 'selectedInstructors'));
    }

    public function update(Request $request, Course $course)
    {
        try {
            Log::info('Course Update - Request Data:', $request->all());
            
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'promotional_video' => 'nullable|string|url',
                'duration_in_weeks' => 'required|string|max:50',
                'lectures_count' => 'required|string|max:50',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'instructor_ids' => 'required|array|min:1',
                'instructor_ids.*' => 'exists:instructors,id',
                'status' => 'required|in:draft,published',
                'requirements' => 'nullable|string',
                'what_you_will_learn' => 'nullable|string',
            ]);

            Log::info('Course Update - Validated Data:', $validated);

            // Update course
            Log::info('Updating course with data:', $validated);
            $updated = $course->update($validated);
            Log::info('Course update result:', ['success' => $updated]);
            
            // Sync instructors
            Log::info('Syncing instructors:', $request->instructor_ids);
            $course->instructors()->sync($request->instructor_ids);

            Log::info('Course updated successfully');

            session()->flash('success', 'تم تحديث الدورة بنجاح');
            return redirect()->route('admin.courses.index');

        } catch (\Exception $e) {
            Log::error('Error updating course: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            session()->flash('error', 'حدث خطأ أثناء تحديث الدورة: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function destroy(Course $course)
    {
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }

        if ($course->promotional_video) {
            Storage::disk('public')->delete($course->promotional_video);
        }

        $course->instructors()->detach();
        $course->delete();

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'تم حذف الدورة بنجاح');
    }
}

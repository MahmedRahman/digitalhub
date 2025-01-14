<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        $nextOrder = $course->lessons()->count() + 1;
        
        return view('admin.lessons.create', compact('course', 'nextOrder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Debug request data
            \Log::info('Lesson creation attempt', [
                'request_data' => $request->all()
            ]);

            $validated = $request->validate([
                'course_id' => 'required|exists:courses,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'content' => 'required|string',
                'video_url' => 'nullable|url',
                'video_duration' => 'nullable|integer|min:1',
                'order' => 'required|integer|min:1',
                'is_free' => 'boolean',
                'is_published' => 'boolean'
            ], [
                'course_id.required' => 'رقم الدورة مطلوب',
                'course_id.exists' => 'الدورة غير موجودة',
                'title.required' => 'عنوان الدرس مطلوب',
                'title.max' => 'عنوان الدرس يجب أن لا يتجاوز 255 حرف',
                'content.required' => 'محتوى الدرس مطلوب',
                'video_url.url' => 'رابط الفيديو غير صالح',
                'video_duration.integer' => 'مدة الفيديو يجب أن تكون رقم صحيح',
                'video_duration.min' => 'مدة الفيديو يجب أن تكون دقيقة واحدة على الأقل',
                'order.required' => 'ترتيب الدرس مطلوب',
                'order.integer' => 'ترتيب الدرس يجب أن يكون رقم صحيح',
                'order.min' => 'ترتيب الدرس يجب أن يكون 1 على الأقل'
            ]);
            
            \Log::info('Validation passed', [
                'validated_data' => $validated
            ]);

            // Convert checkbox values
            $validated['is_free'] = $request->has('is_free');
            $validated['is_published'] = $request->has('is_published');
            
            // Generate slug from title
            $validated['slug'] = Str::slug($validated['title']);
            
            \Log::info('Before slug check', [
                'initial_slug' => $validated['slug']
            ]);

            // Make sure slug is unique
            $baseSlug = $validated['slug'];
            $counter = 1;
            while (Lesson::where('slug', $validated['slug'])->exists()) {
                $validated['slug'] = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            \Log::info('Before lesson creation', [
                'final_data' => $validated
            ]);

            $lesson = Lesson::create($validated);

            \Log::info('Lesson created successfully', [
                'lesson_id' => $lesson->id
            ]);

            return redirect()
                ->route('admin.courses.show', $validated['course_id'])
                ->with('success', 'تم إضافة الدرس بنجاح');
                
        } catch (\Exception $e) {
            \Log::error('Error creating lesson', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'حدث خطأ أثناء إضافة الدرس: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            \Log::info('Attempting to edit lesson', ['lesson_id' => $id]);
            
            $lesson = Lesson::findOrFail($id);
            $course = $lesson->course;
            
            \Log::info('Lesson found', [
                'lesson' => $lesson,
                'course' => $course
            ]);
            
            return view('admin.lessons.edit', compact('lesson', 'course'));
            
        } catch (\Exception $e) {
            \Log::error('Error editing lesson', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()
                ->route('admin.courses.show', $lesson->course_id)
                ->with('error', 'حدث خطأ أثناء تحميل الدرس: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $lesson = Lesson::findOrFail($id);
            
            $validated = $request->validate([
                'course_id' => 'required|exists:courses,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'content' => 'nullable|string',
                'video_url' => 'nullable|url',
                'video_duration' => 'nullable|integer|min:1',
                'order' => 'required|integer|min:1',
            ], [
                'course_id.required' => 'رقم الدورة مطلوب',
                'course_id.exists' => 'الدورة غير موجودة',
                'title.required' => 'عنوان الدرس مطلوب',
                'title.max' => 'عنوان الدرس يجب أن لا يتجاوز 255 حرف',
                'video_url.url' => 'رابط الفيديو غير صالح',
                'video_duration.integer' => 'مدة الفيديو يجب أن تكون رقم صحيح',
                'video_duration.min' => 'مدة الفيديو يجب أن تكون دقيقة واحدة على الأقل',
                'order.required' => 'ترتيب الدرس مطلوب',
                'order.integer' => 'ترتيب الدرس يجب أن يكون رقم صحيح',
                'order.min' => 'ترتيب الدرس يجب أن يكون 1 على الأقل'
            ]);

            // Handle boolean fields
            $validated['is_free'] = $request->has('is_free');
            $validated['is_published'] = $request->has('is_published');

            // Generate slug from title if title changed
            if ($lesson->title !== $validated['title']) {
                $validated['slug'] = Str::slug($validated['title']);
                
                // Make sure slug is unique
                $baseSlug = $validated['slug'];
                $counter = 1;
                while (Lesson::where('slug', $validated['slug'])
                             ->where('id', '!=', $lesson->id)
                             ->exists()) {
                    $validated['slug'] = $baseSlug . '-' . $counter;
                    $counter++;
                }
            }

            $lesson->update($validated);

            return redirect()
                ->route('admin.courses.show', $lesson->course_id)
                ->with('success', 'تم تحديث الدرس بنجاح');
        } catch (\Exception $e) {
            \Log::error('Error updating lesson', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء تحديث الدرس: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $lesson = Lesson::findOrFail($id);
            $lesson->delete();

            return redirect()
                ->route('admin.courses.show', $lesson->course_id)
                ->with('success', 'تم حذف الدرس بنجاح');
        } catch (\Exception $e) {
            \Log::error('Error deleting lesson', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->with('error', 'حدث خطأ أثناء حذف الدرس: ' . $e->getMessage());
        }
    }

    protected function validateLesson(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video' => 'nullable|string|url',
            'order' => 'required|integer|min:1',
            'duration' => 'nullable|string|max:50',
            'course_id' => 'required|exists:courses,id',
            'status' => 'required|in:draft,published'
        ], [
            'title.required' => 'عنوان الدرس مطلوب',
            'title.max' => 'عنوان الدرس يجب أن لا يتجاوز 255 حرف',
            'video.url' => 'رابط الفيديو غير صالح',
            'order.required' => 'ترتيب الدرس مطلوب',
            'order.integer' => 'ترتيب الدرس يجب أن يكون رقم صحيح',
            'order.min' => 'ترتيب الدرس يجب أن يكون 1 على الأقل',
            'duration.max' => 'مدة الفيديو يجب أن لا تتجاوز 50 حرف',
            'course_id.required' => 'رقم الدورة مطلوب',
            'course_id.exists' => 'الدورة غير موجودة',
            'status.required' => 'حالة الدرس مطلوبة',
            'status.in' => 'حالة الدرس يجب أن تكون إما مسودة أو منشورة'
        ]);
    }
}

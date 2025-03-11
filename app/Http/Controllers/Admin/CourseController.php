<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'promotional_video' => 'nullable|string|url',
                'duration_in_weeks' => 'required|integer|min:1',
                'lectures_count' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'instructor_ids' => 'required|array|min:1',
                'instructor_ids.*' => 'exists:instructors,id',
                'level' => 'required|string|in:beginner,intermediate,advanced',
                'status' => 'required|in:draft,published',
                'requirements' => 'nullable|string',
                'what_you_will_learn' => 'nullable|string',
            ], [
                'title.required' => 'عنوان الدورة مطلوب',
                'description.required' => 'وصف الدورة مطلوب',
                'image.required' => 'صورة الدورة مطلوبة',
                'image.image' => 'يجب أن يكون الملف المرفق صورة',
                'image.mimes' => 'صيغة الصورة يجب أن تكون: jpeg, png, jpg, gif',
                'promotional_video.url' => 'رابط الفيديو الترويجي غير صحيح، يجب أن يكون رابط URL صالح',
                'duration_in_weeks.required' => 'مدة الدورة مطلوبة',
                'duration_in_weeks.integer' => 'مدة الدورة يجب أن تكون رقم صحيح',
                'duration_in_weeks.min' => 'مدة الدورة يجب أن تكون على الأقل أسبوع واحد',
                'lectures_count.required' => 'عدد المحاضرات مطلوب',
                'lectures_count.integer' => 'عدد المحاضرات يجب أن يكون رقم صحيح',
                'lectures_count.min' => 'عدد المحاضرات يجب أن يكون على الأقل محاضرة واحدة',
                'price.required' => 'سعر الدورة مطلوب',
                'price.numeric' => 'سعر الدورة يجب أن يكون رقم',
                'price.min' => 'سعر الدورة يجب أن يكون 0 أو أكثر',
                'category_id.required' => 'القسم مطلوب',
                'category_id.exists' => 'القسم المحدد غير موجود',
                'instructor_ids.required' => 'المدربين مطلوبين',
                'instructor_ids.min' => 'يجب اختيار مدرب واحد على الأقل',
                'level.required' => 'مستوى الدورة مطلوب',
                'level.in' => 'مستوى الدورة يجب أن يكون مبتدئ أو متوسط أو متقدم',
                'status.required' => 'حالة الدورة مطلوبة',
                'status.in' => 'حالة الدورة يجب أن تكون إما مسودة أو منشورة',
            ]);

            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('courses/images', 'public');
            }

            // Generate slug from title
            $validated['slug'] = \Str::slug($request->title);
            
            // Set default language
            $validated['language'] = 'arabic';
            
            // Make sure the slug is unique
            $originalSlug = $validated['slug'];
            $counter = 1;
            while (Course::where('slug', $validated['slug'])->exists()) {
                $validated['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }

            $course = Course::create($validated);

            // Sync instructors
            try {
                Log::info('Syncing instructors:', $request->instructor_ids);
                $course->instructors()->sync($request->instructor_ids);
                Log::info('Instructors synced successfully');
            } catch (\Exception $e) {
                Log::error('Error syncing instructors: ' . $e->getMessage());
            }

            return redirect()
                ->route('admin.courses.index')
                ->with('success', 'تم إنشاء الدورة بنجاح');
        } catch (\Exception $e) {
            \Log::error('Error creating course: ' . $e->getMessage());
            return back()->withInput()->withErrors(['general' => 'حدث خطأ أثناء إنشاء الدورة: ' . $e->getMessage()]);
        }
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
        
        // Check if the course has the instructors relationship
        try {
            $selectedInstructors = $course->instructors->pluck('id')->toArray();
        } catch (\Exception $e) {
            // If the relationship doesn't exist, use the instructor_id as a fallback
            $selectedInstructors = $course->instructor_id ? [$course->instructor_id] : [];
        }
        
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
                'duration_in_weeks' => 'required|integer|min:1',
                'lectures_count' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'instructor_ids' => 'required|array|min:1',
                'instructor_ids.*' => 'exists:instructors,id',
                'level' => 'required|string|in:beginner,intermediate,advanced',
                'status' => 'required|in:draft,published',
                'requirements' => 'nullable|string',
                'what_you_will_learn' => 'nullable|string',
            ], [
                'title.required' => 'عنوان الدورة مطلوب',
                'description.required' => 'وصف الدورة مطلوب',
                'image.image' => 'يجب أن يكون الملف المرفق صورة',
                'image.mimes' => 'صيغة الصورة يجب أن تكون: jpeg, png, jpg, gif',
                'promotional_video.url' => 'رابط الفيديو الترويجي غير صحيح، يجب أن يكون رابط URL صالح',
                'duration_in_weeks.required' => 'مدة الدورة مطلوبة',
                'duration_in_weeks.integer' => 'مدة الدورة يجب أن تكون رقم صحيح',
                'duration_in_weeks.min' => 'مدة الدورة يجب أن تكون على الأقل أسبوع واحد',
                'lectures_count.required' => 'عدد المحاضرات مطلوب',
                'lectures_count.integer' => 'عدد المحاضرات يجب أن يكون رقم صحيح',
                'lectures_count.min' => 'عدد المحاضرات يجب أن يكون على الأقل محاضرة واحدة',
                'price.required' => 'سعر الدورة مطلوب',
                'price.numeric' => 'سعر الدورة يجب أن يكون رقم',
                'price.min' => 'سعر الدورة يجب أن يكون 0 أو أكثر',
                'category_id.required' => 'القسم مطلوب',
                'category_id.exists' => 'القسم المحدد غير موجود',
                'instructor_ids.required' => 'المدربين مطلوبين',
                'instructor_ids.min' => 'يجب اختيار مدرب واحد على الأقل',
                'level.required' => 'مستوى الدورة مطلوب',
                'level.in' => 'مستوى الدورة يجب أن يكون مبتدئ أو متوسط أو متقدم',
                'status.required' => 'حالة الدورة مطلوبة',
                'status.in' => 'حالة الدورة يجب أن تكون إما مسودة أو منشورة',
            ]);
            
            // Set default language
            $validated['language'] = 'arabic';
            
            // Update course
            Log::info('Updating course with data:', $validated);
            $updated = $course->update($validated);
            Log::info('Course update result:', ['success' => $updated]);
            
            // Sync instructors
            Log::info('Syncing instructors:', $request->instructor_ids);
            try {
                $course->instructors()->sync($request->instructor_ids);
            } catch (\Exception $e) {
                Log::error('Error syncing instructors: ' . $e->getMessage());
                // If the relationship doesn't exist, update the instructor_id field
                if (isset($request->instructor_ids[0])) {
                    $course->update(['instructor_id' => $request->instructor_ids[0]]);
                }
            }

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

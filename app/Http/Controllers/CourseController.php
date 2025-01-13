<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\CourseEnrollment;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query()->where('status', 'published');

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Apply category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Apply level filter
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Apply language filter
        if ($request->filled('language')) {
            $query->where('language', $request->language);
        }

        // Apply sorting
        switch ($request->get('sort', 'latest')) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $courses = $query->with(['category', 'instructors'])
                        ->paginate(12)
                        ->withQueryString();

        $categories = Category::all();

        return view('courses.index', compact('courses', 'categories'));
    }

    public function show(Course $course)
    {
        abort_if($course->status !== 'published', 404);

        return view('courses.show', compact('course'));
    }

    public function enroll(Course $course)
    {
        // التحقق من عدم وجود طلب اشتراك سابق
        $existingEnrollment = CourseEnrollment::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingEnrollment) {
            if ($existingEnrollment->status === 'pending') {
                return back()->with('info', 'لديك طلب اشتراك قيد المراجعة لهذه الدورة');
            } else {
                return back()->with('info', 'أنت مسجل بالفعل في هذه الدورة');
            }
        }

        // إنشاء طلب اشتراك جديد
        CourseEnrollment::create([
            'user_id' => auth()->id(),
            'course_id' => $course->id,
            'status' => 'pending',
            'payment_status' => 'pending',
            'payment_amount' => $course->price
        ]);

        return back()->with('success', 'تم إرسال طلب الاشتراك بنجاح. سيتم مراجعته من قبل الإدارة.');
    }

    /**
     * Display the course learning interface.
     */
    public function learn(Course $course)
    {
        // Check if user is enrolled in the course
        $enrollment = CourseEnrollment::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->where('status', 'approved')
            ->first();

        if (!$enrollment) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'يجب التسجيل في الدورة أولاً');
        }

        // Load course with its lessons
        $course->load(['lessons' => function($query) {
            $query->orderBy('order');
        }]);

        return view('courses.learn', compact('course', 'enrollment'));
    }
}

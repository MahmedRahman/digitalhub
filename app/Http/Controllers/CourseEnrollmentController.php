<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class CourseEnrollmentController extends Controller
{
    public function enroll(Course $course)
    {
        try {
            // التحقق من وجود تسجيل سابق
            $existingEnrollment = Enrollment::where('user_id', auth()->id())
                ->where('course_id', $course->id)
                ->first();

            if ($existingEnrollment) {
                return redirect()->back()
                    ->with('error', 'عذراً، لقد قمت بالتسجيل في هذه الدورة من قبل');
            }

            // إنشاء تسجيل جديد
            $enrollment = Enrollment::create([
                'user_id' => auth()->id(),
                'course_id' => $course->id,
                'status' => 'pending', // حالة في انتظار الدفع
                'enrolled_at' => now(),
            ]);

            return redirect()->back()
                ->with('success', 'تم تسجيلك في الدورة بنجاح. سيتم التواصل معك من قبل الإدارة لإتمام عملية الدفع.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء التسجيل في الدورة. الرجاء المحاولة مرة أخرى.');
        }
    }

    public function learn(Course $course)
    {
        // التحقق من أن المستخدم مسجل في الدورة
        $enrollment = Enrollment::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'عذراً، يجب عليك التسجيل في الدورة أولاً');
        }

        if ($enrollment->status !== 'approved') {
            return redirect()->route('courses.show', $course)
                ->with('error', 'عذراً، يجب الموافقة على تسجيلك في الدورة أولاً');
        }

        // Load course with its relationships
        $course->load([
            'lessons' => function($query) {
                $query->orderBy('order', 'asc');
            },
            'instructors',
            'category'
        ]);

        return view('courses.learn', compact('course', 'enrollment'));
    }
}

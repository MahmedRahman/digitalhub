<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['user', 'course'])
            ->where('status', 'pending')
            ->latest('enrolled_at')
            ->paginate(15);

        return view('admin.enrollments.index', compact('enrollments'));
    }

    public function approve(Enrollment $enrollment)
    {
        try {
            $enrollment->update([
                'status' => 'approved',
                'enrolled_at' => now()
            ]);

            return back()->with('success', 'تم قبول طلب الاشتراك بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء قبول الطلب: ' . $e->getMessage());
        }
    }

    public function reject(Enrollment $enrollment, Request $request)
    {
        try {
            $enrollment->update([
                'status' => 'rejected',
                'notes' => $request->notes
            ]);

            return back()->with('success', 'تم رفض طلب الاشتراك');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء رفض الطلب: ' . $e->getMessage());
        }
    }
}

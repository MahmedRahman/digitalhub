<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveCourseRound;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LiveCourseRoundStudentController extends Controller
{
    public function index(LiveCourseRound $round)
    {
        // Get students with pagination
        $students = $round->students()
            ->withPivot('payment_status', 'total_amount', 'paid_amount', 'remaining_amount', 'payment_notes', 'created_at')
            ->paginate(10);

        // Get available students (students who are not enrolled in this round)
        $availableStudents = User::where('type', 'student')
            ->whereNotIn('id', $round->students->pluck('id'))
            ->get();

        return view('admin.live-course-rounds.students.index', compact('round', 'students', 'availableStudents'));
    }

    public function store(Request $request, LiveCourseRound $round)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'payment_status' => 'required|in:pending,paid',
        ]);

        try {
            // Check if student is already enrolled
            if ($round->students()->where('user_id', $request->student_id)->exists()) {
                return back()->with('error', 'الطالب مسجل بالفعل في هذه الجولة');
            }

            // Set initial payment details
            $totalAmount = $round->price;
            
            // Enroll student
            $round->students()->attach($request->student_id, [
                'payment_status' => $request->payment_status,
                'total_amount' => $totalAmount,
                'paid_amount' => 0,
                'remaining_amount' => $totalAmount,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return back()->with('success', 'تم إضافة الطالب بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء إضافة الطالب');
        }
    }

    public function remove(LiveCourseRound $round, User $student)
    {
        try {
            $round->students()->detach($student->id);
            return back()->with('success', 'تم إزالة الطالب بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء إزالة الطالب');
        }
    }

    public function updatePayment(Request $request, LiveCourseRound $round, User $student)
    {
        $request->validate([
            'total_amount' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'payment_notes' => 'nullable|string',
        ]);

        try {
            $totalAmount = $request->total_amount;
            $paidAmount = $request->paid_amount;
            $remainingAmount = $totalAmount - $paidAmount;
            
            // Update payment details
            $round->students()->updateExistingPivot($student->id, [
                'total_amount' => $totalAmount,
                'paid_amount' => $paidAmount,
                'remaining_amount' => $remainingAmount,
                'payment_notes' => $request->payment_notes,
                'payment_status' => $remainingAmount <= 0 ? 'paid' : 'pending',
                'updated_at' => now(),
            ]);

            return back()->with('success', 'تم تحديث المدفوعات بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء تحديث المدفوعات');
        }
    }
}

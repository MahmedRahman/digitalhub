<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveCourseRound;
use App\Models\StudentPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentPaymentController extends Controller
{
    public function store(Request $request, LiveCourseRound $round, User $student)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,bank_transfer',
            'reference_number' => 'nullable|required_if:payment_method,bank_transfer|string',
            'notes' => 'nullable|string'
        ]);

        try {
            // إنشاء الدفعة
            $payment = StudentPayment::create([
                'live_course_round_id' => $round->id,
                'user_id' => $student->id,
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'reference_number' => $request->reference_number,
                'notes' => $request->notes
            ]);

            // تحديث إجمالي المدفوعات للطالب
            $totalPaid = $round->students()->where('user_id', $student->id)->first()->pivot->paid_amount + $request->amount;
            $totalAmount = $round->students()->where('user_id', $student->id)->first()->pivot->total_amount;
            
            $round->students()->updateExistingPivot($student->id, [
                'paid_amount' => $totalPaid,
                'remaining_amount' => $totalAmount - $totalPaid,
                'payment_status' => ($totalAmount <= $totalPaid) ? 'paid' : 'pending'
            ]);

            return back()->with('success', 'تم تسجيل الدفعة بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء تسجيل الدفعة');
        }
    }

    public function receipt(LiveCourseRound $round, User $student, StudentPayment $payment)
    {
        // التحقق من أن الدفعة تخص الطالب والجولة المحددة
        if ($payment->user_id !== $student->id || $payment->live_course_round_id !== $round->id) {
            abort(404);
        }

        // تحميل العلاقات المطلوبة
        $round->load('livecourse');
        $payment->load('user');

        return view('admin.live-course-rounds.students.receipt', [
            'payment' => $payment,
            'student' => $student,
            'round' => $round
        ]);
    }

    public function verify($receipt_number)
    {
        $payment = StudentPayment::where('receipt_number', $receipt_number)->firstOrFail();
        
        return view('admin.live-course-rounds.students.verify-receipt', [
            'payment' => $payment,
            'student' => $payment->user,
            'round' => $payment->liveCourseRound
        ]);
    }
}

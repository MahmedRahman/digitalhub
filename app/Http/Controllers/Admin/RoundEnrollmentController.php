<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoundEnrollment;
use App\Models\RoundPayment;
use App\Models\User;
use App\Models\LiveCourseRound;
use Illuminate\Http\Request;

class RoundEnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = RoundEnrollment::with(['user', 'round.livecourse'])
            ->latest()
            ->paginate(10);
        
        return view('admin.round-enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        $rounds = LiveCourseRound::with('livecourse')->get();
        return view('admin.round-enrollments.create', compact('users', 'rounds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'live_course_round_id' => 'required|exists:live_course_rounds,id',
            'total_price' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0|max:' . $request->total_price,
            'payment_method' => 'required|in:cash,bank_transfer,other',
            'notes' => 'nullable|string'
        ]);

        $enrollment = RoundEnrollment::create([
            'user_id' => $request->user_id,
            'live_course_round_id' => $request->live_course_round_id,
            'total_price' => $request->total_price,
            'paid_amount' => $request->paid_amount,
            'notes' => $request->notes,
            'enrollment_status' => 'pending'
        ]);

        if ($request->paid_amount > 0) {
            RoundPayment::create([
                'round_enrollment_id' => $enrollment->id,
                'amount' => $request->paid_amount,
                'payment_method' => $request->payment_method,
                'notes' => 'دفعة أولى'
            ]);
        }

        $enrollment->updatePaymentStatus();

        return redirect()->route('admin.round-enrollments.index')
            ->with('success', 'تم تسجيل الطالب بنجاح');
    }

    public function show($id)
    {
        try {
            $enrollment = RoundEnrollment::with([
                'user',
                'round' => function($query) {
                    $query->with('livecourse');
                },
                'payments' => function($query) {
                    $query->orderBy('created_at', 'desc');
                }
            ])->findOrFail($id);
            
            // التحقق من وجود البيانات المطلوبة
            if (!$enrollment->user) {
                throw new \Exception('بيانات المستخدم غير متوفرة');
            }
            
            if (!$enrollment->round || !$enrollment->round->livecourse) {
                throw new \Exception('بيانات الدورة غير متوفرة');
            }
            
            // حساب المبلغ المتبقي
            $enrollment->remaining_amount = $enrollment->total_price - $enrollment->paid_amount;
            
            return view('admin.round-enrollments.show', compact('enrollment'));
            
        } catch (\Exception $e) {
            return redirect()->route('admin.round-enrollments.index')
                ->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }

    public function addPayment(Request $request, RoundEnrollment $enrollment)
    {
        $request->validate([
            'amount' => [
                'required',
                'numeric',
                'min:0.01',
                function ($attribute, $value, $fail) use ($enrollment) {
                    if ($value > $enrollment->remaining_amount) {
                        $fail('مبلغ الدفع يتجاوز المبلغ المتبقي');
                    }
                },
            ],
            'payment_method' => 'required|in:cash,bank_transfer,other',
            'notes' => 'nullable|string'
        ]);

        RoundPayment::create([
            'round_enrollment_id' => $enrollment->id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes
        ]);

        $enrollment->paid_amount += $request->amount;
        $enrollment->save();
        $enrollment->updatePaymentStatus();

        return redirect()->back()->with('success', 'تم تسجيل الدفعة بنجاح');
    }

    public function updateStatus(Request $request, RoundEnrollment $enrollment)
    {
        $request->validate([
            'enrollment_status' => 'required|in:pending,approved,rejected'
        ]);

        $enrollment->update([
            'enrollment_status' => $request->enrollment_status
        ]);

        return redirect()->back()->with('success', 'تم تحديث حالة التسجيل بنجاح');
    }

    public function invoice($id)
    {
        $enrollment = RoundEnrollment::with([
            'user',
            'round' => function($query) {
                $query->with('livecourse');
            },
            'payments'
        ])->findOrFail($id);
        
        // التحقق من وجود البيانات
        if (!$enrollment->round || !$enrollment->round->livecourse) {
            abort(404, 'بيانات الدورة غير متوفرة');
        }
        
        if (!$enrollment->user) {
            abort(404, 'بيانات المستخدم غير متوفرة');
        }
            
        return view('admin.round-enrollments.invoice', compact('enrollment'));
    }
}

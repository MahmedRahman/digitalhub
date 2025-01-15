<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    protected $fillable = [
        'live_course_round_id',
        'user_id',
        'amount',
        'payment_method',
        'reference_number',
        'receipt_number',
        'notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2'
    ];

    /**
     * علاقة مع الطالب
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * علاقة مع جولة الدورة
     */
    public function liveCourseRound()
    {
        return $this->belongsTo(LiveCourseRound::class);
    }

    /**
     * توليد رقم فاتورة فريد
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            $lastPayment = static::latest()->first();
            $lastNumber = $lastPayment ? intval(substr($lastPayment->receipt_number, -4)) : 0;
            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            $payment->receipt_number = date('Ymd') . $nextNumber;
        });
    }
}

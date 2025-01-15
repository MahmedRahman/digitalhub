<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoundEnrollment extends Model
{
    protected $fillable = [
        'user_id',
        'live_course_round_id',
        'total_price',
        'paid_amount',
        'payment_status',
        'enrollment_status',
        'notes'
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function round()
    {
        return $this->belongsTo(LiveCourseRound::class, 'live_course_round_id');
    }

    public function payments()
    {
        return $this->hasMany(RoundPayment::class);
    }

    public function updatePaymentStatus()
    {
        if ($this->paid_amount == 0) {
            $this->payment_status = 'pending';
        } elseif ($this->paid_amount < $this->total_price) {
            $this->payment_status = 'partial';
        } else {
            $this->payment_status = 'completed';
        }
        $this->save();
    }
}

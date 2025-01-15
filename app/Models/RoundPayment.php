<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoundPayment extends Model
{
    protected $fillable = [
        'round_enrollment_id',
        'amount',
        'payment_method',
        'transaction_id',
        'notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function enrollment()
    {
        return $this->belongsTo(RoundEnrollment::class, 'round_enrollment_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AiMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_date',
        'phone_number',
        'client_question',
        'ai_response'
    ];

    // Cast message_date to datetime
    protected $dates = [
        'message_date'
    ];

    // Optional: Mutator to ensure message_date is always a Carbon instance
    public function getMessageDateAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }
}

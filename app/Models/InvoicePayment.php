<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoicePayment extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'invoicetime',
        'invoicevalue',
        'invoicetype',
        'invoiceimage',
        'invoicenote',
        'status'
    ];

    protected $casts = [
        'invoicetime' => 'datetime',
        'invoicevalue' => 'decimal:2'
    ];
}

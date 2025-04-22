<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display the payment methods page.
     *
     * @return \Illuminate\View\View
     */
    public function methods()
    {
        return view('pages.payment-methods');
    }
}

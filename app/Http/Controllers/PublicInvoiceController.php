<?php

namespace App\Http\Controllers;

use App\Models\InvoicePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicInvoiceController extends Controller
{
    /**
     * Store a newly created invoice from public users.
     * This method doesn't require authentication.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'invoicetime' => 'required|date',
            'invoicevalue' => 'required|numeric|min:0',
            'invoicetype' => 'required|string|max:255',
            'invoiceimage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'invoicenote' => 'nullable|string',
        ]);
        
        // Set default status for public submissions
        $validated['status'] = 'pending';
        
        // Handle file upload if present
        if ($request->hasFile('invoiceimage')) {
            $path = $request->file('invoiceimage')->store('invoice_images', 'public');
            $validated['invoiceimage'] = $path;
        }
        
        // Create the invoice
        $invoice = InvoicePayment::create($validated);
        
        // For AJAX requests, return JSON response
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'تم إرسال الفاتورة بنجاح',
                'invoice' => $invoice
            ]);
        }
        
        // For regular requests, redirect back with success message
        return redirect()->back()
            ->with('success', 'تم إرسال الفاتورة بنجاح');
    }
}

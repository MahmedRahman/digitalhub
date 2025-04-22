<?php

namespace App\Http\Controllers\Admin;

use App\Models\InvoicePayment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = InvoicePayment::latest()->paginate(10);
        return view('admin.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $invoiceTypes = ['course', 'subscription', 'service', 'other'];
        return view('admin.invoices.create', compact('invoiceTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        
        if ($request->hasFile('invoiceimage')) {
            $path = $request->file('invoiceimage')->store('invoice_images', 'public');
            $validated['invoiceimage'] = $path;
        }
        
        InvoicePayment::create($validated);
        
        return redirect()->route('admin.invoices.index')
            ->with('success', 'تم إنشاء الفاتورة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = InvoicePayment::findOrFail($id);
        return view('admin.invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = InvoicePayment::findOrFail($id);
        $invoiceTypes = ['course', 'subscription', 'service', 'other'];
        return view('admin.invoices.edit', compact('invoice', 'invoiceTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoice = InvoicePayment::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'invoicetime' => 'required|date',
            'invoicevalue' => 'required|numeric|min:0',
            'invoicetype' => 'required|string|max:255',
            'invoiceimage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'invoicenote' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);
        
        if ($request->hasFile('invoiceimage')) {
            // Delete old image if exists
            if ($invoice->invoiceimage) {
                Storage::disk('public')->delete($invoice->invoiceimage);
            }
            
            $path = $request->file('invoiceimage')->store('invoice_images', 'public');
            $validated['invoiceimage'] = $path;
        }
        
        $invoice->update($validated);
        
        return redirect()->route('admin.invoices.index')
            ->with('success', 'تم تحديث الفاتورة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = InvoicePayment::findOrFail($id);
        
        // Delete image if exists
        if ($invoice->invoiceimage) {
            Storage::disk('public')->delete($invoice->invoiceimage);
        }
        
        $invoice->delete();
        
        return redirect()->route('admin.invoices.index')
            ->with('success', 'تم حذف الفاتورة بنجاح');
    }
    
    /**
     * Update the status of an invoice.
     */
    public function updateStatus(Request $request, string $id)
    {
        $invoice = InvoicePayment::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);
        
        $invoice->update($validated);
        
        return redirect()->route('admin.invoices.index')
            ->with('success', 'تم تحديث حالة الفاتورة بنجاح');
    }
}

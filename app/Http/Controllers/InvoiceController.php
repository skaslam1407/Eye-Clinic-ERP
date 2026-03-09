<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['patient', 'doctor'])->latest()->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        return view('invoices.create', [
            'patients' => Patient::orderBy('name')->get(),
            'doctors' => User::whereHas('role', fn ($q) => $q->where('name', 'Doctor'))->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['nullable', 'exists:users,id'],
            'eye_test_charges' => ['required', 'numeric', 'min:0'],
            'eyeglass_charges' => ['required', 'numeric', 'min:0'],
            'medicine_charges' => ['required', 'numeric', 'min:0'],
            'payment_status' => ['required', 'in:Paid,Pending'],
            'invoice_date' => ['required', 'date'],
        ]);

        $validated['total_amount'] = $validated['eye_test_charges'] + $validated['eyeglass_charges'] + $validated['medicine_charges'];
        $validated['invoice_number'] = $this->nextInvoiceNumber();

        $invoice = Invoice::create($validated);

        return redirect()->route('invoices.show', $invoice)->with('success', 'Invoice created successfully.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['patient', 'doctor']);
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        return view('invoices.edit', [
            'invoice' => $invoice,
            'patients' => Patient::orderBy('name')->get(),
            'doctors' => User::whereHas('role', fn ($q) => $q->where('name', 'Doctor'))->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['nullable', 'exists:users,id'],
            'eye_test_charges' => ['required', 'numeric', 'min:0'],
            'eyeglass_charges' => ['required', 'numeric', 'min:0'],
            'medicine_charges' => ['required', 'numeric', 'min:0'],
            'payment_status' => ['required', 'in:Paid,Pending'],
            'invoice_date' => ['required', 'date'],
        ]);
        $validated['total_amount'] = $validated['eye_test_charges'] + $validated['eyeglass_charges'] + $validated['medicine_charges'];

        $invoice->update($validated);
        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }

    public function print(Invoice $invoice)
    {
        $invoice->load(['patient', 'doctor']);
        return view('invoices.print', compact('invoice'));
    }

    public function download(Invoice $invoice)
    {
        $invoice->load(['patient', 'doctor']);
        $html = view('invoices.pdf', compact('invoice'))->render();

        return response($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'attachment; filename="'.$invoice->invoice_number.'.html"');
    }

    private function nextInvoiceNumber(): string
    {
        $lastId = (int) Invoice::max('id') + 1;
        return 'INV-' . now()->format('Y') . '-' . str_pad((string) $lastId, 5, '0', STR_PAD_LEFT);
    }
}

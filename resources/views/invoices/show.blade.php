@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Invoice {{ $invoice->invoice_number }}</h4>
    <div>
        <a href="{{ route('invoices.print', $invoice) }}" class="btn btn-outline-secondary" target="_blank">Print</a>
        <a href="{{ route('invoices.download', $invoice) }}" class="btn btn-dark">Download PDF</a>
    </div>
</div>
<div class="card border-0 shadow-sm"><div class="card-body">
    <div class="row g-2 mb-3">
        <div class="col-md-6"><strong>Patient:</strong> {{ optional($invoice->patient)->name }}</div>
        <div class="col-md-6"><strong>Doctor:</strong> {{ optional($invoice->doctor)->name }}</div>
        <div class="col-md-6"><strong>Date:</strong> {{ $invoice->invoice_date?->format('Y-m-d') }}</div>
        <div class="col-md-6"><strong>Status:</strong> {{ $invoice->payment_status }}</div>
    </div>
    <table class="table table-bordered">
        <tr><th>Eye Test</th><td>{{ number_format($invoice->eye_test_charges,2) }}</td></tr>
        <tr><th>Eyeglass</th><td>{{ number_format($invoice->eyeglass_charges,2) }}</td></tr>
        <tr><th>Medicine</th><td>{{ number_format($invoice->medicine_charges,2) }}</td></tr>
        <tr><th>Total</th><td><strong>{{ number_format($invoice->total_amount,2) }}</strong></td></tr>
    </table>
</div></div>
@endsection

@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-1">Invoice {{ $invoice->invoice_number }}</h4>
        <small class="text-muted">Issued {{ $invoice->invoice_date?->format('d M Y') }}</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('invoices.print', $invoice) }}" class="btn btn-outline-dark btn-sm" target="_blank">Print</a>
        <a href="{{ route('invoices.download', $invoice) }}" class="btn btn-dark btn-sm">Download</a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="row g-3 mb-4 align-items-center">
            <div class="col-md-8">
                <div class="d-flex gap-3 align-items-center">
                    @if($invoice->logo_path)
                        <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:12px;padding:10px;">
                            <img src="{{ asset('storage/'.$invoice->logo_path) }}" alt="Clinic logo" style="height:58px;width:auto;object-fit:contain;border-radius:10px;">
                        </div>
                    @endif
                    <div>
                        <h5 class="mb-1">{{ optional($invoice->patient)->name }}</h5>
                        <div class="text-muted small">Patient • {{ optional($invoice->patient)->patient_code }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="fw-semibold">{{ optional($invoice->doctor)->name ?? '—' }}</div>
                <small class="text-muted">Doctor</small>
            </div>
        </div>

        <div class="row g-3 mb-3">
            @php
                $summary = [
                    ['label' => 'Eye Test', 'value' => $invoice->eye_test_charges],
                    ['label' => 'Eyeglass', 'value' => $invoice->eyeglass_charges],
                    ['label' => 'Medicine', 'value' => $invoice->medicine_charges],
                    ['label' => 'Total', 'value' => $invoice->total_amount, 'emphasis' => true],
                ];
            @endphp
            @foreach($summary as $item)
                <div class="col-md-3">
                    <div class="p-3 rounded-3 border h-100" style="background:#f8fafc;border-color:#e5e7eb;">
                        <div class="text-muted small">{{ $item['label'] }}</div>
                        <div class="{{ $item['emphasis'] ?? false ? 'fs-4' : 'fs-5' }} fw-bold {{ ($item['emphasis'] ?? false) ? 'text-primary' : '' }}">
                            ₹ {{ number_format($item['value'],2) }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-end mb-2">
            <span class="badge rounded-pill @class([
                'text-bg-success' => $invoice->payment_status === 'Paid',
                'text-bg-warning' => $invoice->payment_status === 'Pending',
            ])">{{ $invoice->payment_status }}</span>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th class="text-end">Amount (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Eye Test Charges</td><td class="text-end">{{ number_format($invoice->eye_test_charges,2) }}</td></tr>
                    <tr><td>Eyeglass Charges</td><td class="text-end">{{ number_format($invoice->eyeglass_charges,2) }}</td></tr>
                    <tr><td>Medicine Charges</td><td class="text-end">{{ number_format($invoice->medicine_charges,2) }}</td></tr>
                    <tr class="table-light fw-semibold"><td>Total Amount</td><td class="text-end">₹ {{ number_format($invoice->total_amount,2) }}</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

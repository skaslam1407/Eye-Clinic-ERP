<!DOCTYPE html>
<html>
<head>
    <title>Print Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Manrope', Arial, sans-serif; background: #f5f7fb; }
        .invoice-card { background: #fff; border-radius: 16px; padding: 32px; border: 1px solid #e5e7eb; }
        .pill { border-radius: 999px; padding: 6px 14px; font-size: 0.85rem; }
        .pill-paid { background: #dcfce7; color: #166534; }
        .pill-pending { background: #fef9c3; color: #854d0e; }
        .amount-row { background: #f8fafc; border-radius: 12px; border: 1px solid #e5e7eb; }
        .table th { background: #f1f5f9; }
    </style>
</head>
<body class="p-4" onload="window.print()">
    <div class="invoice-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex gap-3 align-items-center">
                @php
                    $logo = $invoice->logo_path
                        ? asset('storage/'.$invoice->logo_path)
                        : ($branding?->logo_path ? asset('storage/'.$branding->logo_path) : null);
                @endphp
                @if($logo)
                <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:12px;padding:10px;">
                    <img src="{{ $logo }}" alt="Clinic logo" style="height:58px;width:auto;object-fit:contain;border-radius:10px;">
                </div>
                @endif
                <div>
                    <h4 class="mb-1">Eye Clinic Invoice</h4>
                    <div class="text-muted">Invoice #{{ $invoice->invoice_number }}</div>
                </div>
            </div>
            <div>
                <div class="fw-semibold text-end">{{ optional($invoice->doctor)->name ?? 'Doctor' }}</div>
                <small class="text-muted">{{ $invoice->invoice_date?->format('d M Y') }}</small>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6"><strong>Patient:</strong> {{ optional($invoice->patient)->name }}</div>
            <div class="col-md-6"><strong>Patient Code:</strong> {{ optional($invoice->patient)->patient_code }}</div>
        </div>

        <div class="row g-2 mb-3">
            <div class="col-md-4">
                <div class="p-3 amount-row">
                    <div class="text-muted small">Eye Test Charges</div>
                    <div class="fs-5 fw-bold">₹ {{ number_format($invoice->eye_test_charges,2) }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 amount-row">
                    <div class="text-muted small">Eyeglass Charges</div>
                    <div class="fs-5 fw-bold">₹ {{ number_format($invoice->eyeglass_charges,2) }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 amount-row">
                    <div class="text-muted small">Medicine Charges</div>
                    <div class="fs-5 fw-bold">₹ {{ number_format($invoice->medicine_charges,2) }}</div>
                </div>
            </div>
        </div>

        <table class="table table-bordered align-middle mb-3">
            <thead><tr><th>Item</th><th class="text-end">Amount (₹)</th></tr></thead>
            <tbody>
                <tr><td>Eye Test Charges</td><td class="text-end">{{ number_format($invoice->eye_test_charges,2) }}</td></tr>
                <tr><td>Eyeglass Charges</td><td class="text-end">{{ number_format($invoice->eyeglass_charges,2) }}</td></tr>
                <tr><td>Medicine Charges</td><td class="text-end">{{ number_format($invoice->medicine_charges,2) }}</td></tr>
                <tr class="table-light fw-semibold"><td>Total Amount</td><td class="text-end">₹ {{ number_format($invoice->total_amount,2) }}</td></tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center">
            <div>
                <strong>Payment Status:</strong>
                <span class="pill {{ $invoice->payment_status === 'Paid' ? 'pill-paid' : 'pill-pending' }}">{{ $invoice->payment_status }}</span>
            </div>
            <div class="text-muted">Thank you for your visit.</div>
        </div>
    </div>
</body>
</html>

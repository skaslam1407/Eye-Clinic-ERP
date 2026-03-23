<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $invoice->invoice_number }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&display=swap');
        body { font-family: 'Manrope', Arial, sans-serif; padding: 28px; background: #f7f9fb; }
        .card { background: #fff; border-radius: 14px; padding: 24px; border: 1px solid #e5e7eb; }
        h2 { margin: 0 0 6px; letter-spacing: -0.3px; }
        .muted { color: #6b7280; font-size: 0.9rem; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #e5e7eb; padding: 10px; }
        th { background: #f1f5f9; text-align: left; }
        .pill { border-radius: 999px; padding: 6px 14px; font-size: 0.85rem; display: inline-block; }
        .pill-paid { background: #dcfce7; color: #166534; }
        .pill-pending { background: #fef9c3; color: #854d0e; }
    </style>
</head>
<body>
    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;">
            <div style="display:flex;align-items:center;gap:14px;">
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
                    <h2>Eye Clinic Invoice</h2>
                    <div class="muted">Invoice #{{ $invoice->invoice_number }}</div>
                </div>
            </div>
            <div style="text-align:right;">
                <div style="font-weight:700;">{{ optional($invoice->doctor)->name ?? 'Doctor' }}</div>
                <div class="muted">{{ $invoice->invoice_date?->format('d M Y') }}</div>
            </div>
        </div>

        <div style="display:flex;justify-content:space-between;gap:16px;margin-top:16px;">
            <div><strong>Patient:</strong> {{ optional($invoice->patient)->name }}</div>
            <div><strong>Patient Code:</strong> {{ optional($invoice->patient)->patient_code }}</div>
        </div>

        <table>
            <thead><tr><th>Item</th><th style="text-align:right;">Amount (₹)</th></tr></thead>
            <tbody>
                <tr><td>Eye Test Charges</td><td style="text-align:right;">{{ number_format($invoice->eye_test_charges,2) }}</td></tr>
                <tr><td>Eyeglass Charges</td><td style="text-align:right;">{{ number_format($invoice->eyeglass_charges,2) }}</td></tr>
                <tr><td>Medicine Charges</td><td style="text-align:right;">{{ number_format($invoice->medicine_charges,2) }}</td></tr>
                <tr style="background:#f8fafc;font-weight:700;"><td>Total Amount</td><td style="text-align:right;">₹ {{ number_format($invoice->total_amount,2) }}</td></tr>
            </tbody>
        </table>

        <div style="margin-top:16px;display:flex;justify-content:space-between;align-items:center;">
            <div>
                <strong>Payment Status:</strong>
                <span class="pill {{ $invoice->payment_status === 'Paid' ? 'pill-paid' : 'pill-pending' }}">{{ $invoice->payment_status }}</span>
            </div>
            <div class="muted">Thank you for choosing our clinic.</div>
        </div>
    </div>
</body>
</html>

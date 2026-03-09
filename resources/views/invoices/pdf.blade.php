<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>{{ $invoice->invoice_number }}</title>
<style>body{font-family:Arial,sans-serif;padding:24px;}table{border-collapse:collapse;width:100%;}td,th{border:1px solid #ccc;padding:8px;}</style></head>
<body>
<h2>Eye Clinic Invoice - {{ $invoice->invoice_number }}</h2>
<p>Patient: {{ optional($invoice->patient)->name }}</p>
<p>Doctor: {{ optional($invoice->doctor)->name }}</p>
<p>Date: {{ $invoice->invoice_date?->format('Y-m-d') }}</p>
<table>
<tr><th>Eye Test Charges</th><td>{{ number_format($invoice->eye_test_charges,2) }}</td></tr>
<tr><th>Eyeglass Charges</th><td>{{ number_format($invoice->eyeglass_charges,2) }}</td></tr>
<tr><th>Medicine Charges</th><td>{{ number_format($invoice->medicine_charges,2) }}</td></tr>
<tr><th>Total Amount</th><td><strong>{{ number_format($invoice->total_amount,2) }}</strong></td></tr>
</table>
<p>Payment Status: {{ $invoice->payment_status }}</p>
</body></html>

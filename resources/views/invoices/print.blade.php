<!DOCTYPE html>
<html><head><title>Print Invoice</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="p-4" onload="window.print()">
<h3>Invoice {{ $invoice->invoice_number }}</h3>
<p><strong>Patient:</strong> {{ optional($invoice->patient)->name }} | <strong>Doctor:</strong> {{ optional($invoice->doctor)->name }}</p>
<table class="table table-bordered">
<tr><th>Eye Test Charges</th><td>{{ number_format($invoice->eye_test_charges,2) }}</td></tr>
<tr><th>Eyeglass Charges</th><td>{{ number_format($invoice->eyeglass_charges,2) }}</td></tr>
<tr><th>Medicine Charges</th><td>{{ number_format($invoice->medicine_charges,2) }}</td></tr>
<tr><th>Total Amount</th><td><strong>{{ number_format($invoice->total_amount,2) }}</strong></td></tr>
</table>
<p><strong>Payment Status:</strong> {{ $invoice->payment_status }}</p>
</body></html>

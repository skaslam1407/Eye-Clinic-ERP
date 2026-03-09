@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3"><h4>Invoices</h4><a class="btn btn-dark" href="{{ route('invoices.create') }}">Create Invoice</a></div>
<div class="card border-0 shadow-sm"><div class="card-body table-wrap">
<table class="table table-striped align-middle">
<thead><tr><th>Invoice #</th><th>Patient</th><th>Doctor</th><th>Date</th><th>Total</th><th>Status</th><th class="text-end">Action</th></tr></thead>
<tbody>
@forelse($invoices as $invoice)
<tr>
<td>{{ $invoice->invoice_number }}</td><td>{{ optional($invoice->patient)->name }}</td><td>{{ optional($invoice->doctor)->name }}</td><td>{{ $invoice->invoice_date?->format('Y-m-d') }}</td><td>{{ number_format($invoice->total_amount,2) }}</td><td>{{ $invoice->payment_status }}</td>
<td class="text-end">
<a href="{{ route('invoices.show',$invoice) }}" class="btn btn-sm btn-outline-secondary">View</a>
<a href="{{ route('invoices.edit',$invoice) }}" class="btn btn-sm btn-outline-primary">Edit</a>
<form class="d-inline" method="POST" action="{{ route('invoices.destroy',$invoice) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete invoice?')">Delete</button></form>
</td>
</tr>
@empty
<tr><td colspan="7">No invoices found.</td></tr>
@endforelse
</tbody>
</table>
{{ $invoices->links() }}
</div></div>
@endsection

@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3"><h4>Eyeglass Delivery</h4><a class="btn btn-dark" href="{{ route('eyeglass-orders.create') }}">Add Order</a></div>
<div class="card border-0 shadow-sm"><div class="card-body table-wrap">
<table class="table table-striped"><thead><tr><th>Order ID</th><th>Patient</th><th>Type</th><th>Lens</th><th>Order Date</th><th>Delivery Date</th><th>Status</th><th class="text-end">Action</th></tr></thead>
<tbody>
@forelse($orders as $order)
<tr>
<td>{{ $order->id }}</td><td>{{ optional($order->patient)->name }}</td><td>{{ $order->eyeglass_type }}</td><td>{{ $order->lens_power }}</td><td>{{ $order->order_date?->format('Y-m-d') }}</td><td>{{ $order->delivery_date?->format('Y-m-d') }}</td><td>{{ $order->delivery_status }}</td>
<td class="text-end">
@if($order->delivery_status === 'Pending')
<form method="POST" action="{{ route('eyeglass-orders.mark-delivered',$order) }}" class="d-inline">@csrf @method('PATCH')<button class="btn btn-sm btn-outline-success">Mark Delivered</button></form>
@endif
<a href="{{ route('eyeglass-orders.edit',$order) }}" class="btn btn-sm btn-outline-primary">Edit</a>
<form method="POST" action="{{ route('eyeglass-orders.destroy',$order) }}" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete order?')">Delete</button></form>
</td></tr>
@empty
<tr><td colspan="8">No delivery orders found.</td></tr>
@endforelse
</tbody></table>
{{ $orders->links() }}
</div></div>
@endsection

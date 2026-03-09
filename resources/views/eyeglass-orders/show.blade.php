@extends('layouts.app')
@section('content')
<h4 class="mb-3">Order Details</h4>
<div class="card border-0 shadow-sm"><div class="card-body">
<p><strong>Patient:</strong> {{ optional($order->patient)->name }}</p>
<p><strong>Type:</strong> {{ $order->eyeglass_type }}</p>
<p><strong>Lens Power:</strong> {{ $order->lens_power }}</p>
<p><strong>Order Date:</strong> {{ $order->order_date?->format('Y-m-d') }}</p>
<p><strong>Delivery Date:</strong> {{ $order->delivery_date?->format('Y-m-d') }}</p>
<p><strong>Status:</strong> {{ $order->delivery_status }}</p>
</div></div>
@endsection

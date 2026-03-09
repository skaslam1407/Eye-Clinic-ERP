@extends('layouts.app')
@section('content')
<h4 class="mb-3">Appointment Details</h4>
<div class="card border-0 shadow-sm"><div class="card-body">
<p><strong>Patient:</strong> {{ optional($appointment->patient)->name }}</p>
<p><strong>Doctor:</strong> {{ optional($appointment->doctor)->name }}</p>
<p><strong>Date:</strong> {{ $appointment->appointment_date?->format('Y-m-d') }}</p>
<p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}</p>
<p><strong>Status:</strong> {{ $appointment->status }}</p>
<p><strong>Notes:</strong> {{ $appointment->notes }}</p>
</div></div>
@endsection

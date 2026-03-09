@extends('layouts.app')
@section('content')
<h4 class="mb-3">Appointment Calendar</h4>
<div class="card border-0 shadow-sm"><div class="card-body table-wrap">
<table class="table table-bordered">
<thead><tr><th>Date</th><th>Time</th><th>Patient</th><th>Doctor</th><th>Status</th></tr></thead>
<tbody>
@forelse($appointments as $appointment)
<tr><td>{{ $appointment->appointment_date?->format('Y-m-d') }}</td><td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}</td><td>{{ optional($appointment->patient)->name }}</td><td>{{ optional($appointment->doctor)->name }}</td><td>{{ $appointment->status }}</td></tr>
@empty
<tr><td colspan="5">No appointment entries.</td></tr>
@endforelse
</tbody>
</table>
</div></div>
@endsection

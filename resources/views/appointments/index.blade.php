@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3"><h4>Appointments</h4><div><a class="btn btn-outline-secondary" href="{{ route('appointments.calendar') }}">Calendar</a> <a class="btn btn-dark" href="{{ route('appointments.create') }}">Request Appointment</a></div></div>
<form method="GET" class="row g-2 mb-3"><div class="col-md-3"><select class="form-select" name="status"><option value="">All Status</option>@foreach(['Pending','Approved','Cancelled'] as $s)<option value="{{ $s }}" @selected($status===$s)>{{ $s }}</option>@endforeach</select></div><div class="col-md-2"><button class="btn btn-outline-dark w-100">Filter</button></div></form>
<div class="card border-0 shadow-sm"><div class="card-body table-wrap">
<table class="table table-striped">
<thead><tr><th>Patient</th><th>Doctor</th><th>Date</th><th>Time</th><th>Status</th><th class="text-end">Action</th></tr></thead>
<tbody>
@forelse($appointments as $appointment)
<tr>
<td>{{ optional($appointment->patient)->name }}</td><td>{{ optional($appointment->doctor)->name }}</td><td>{{ $appointment->appointment_date?->format('Y-m-d') }}</td><td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}</td><td>{{ $appointment->status }}</td>
<td class="text-end">
<a href="{{ route('appointments.edit',$appointment) }}" class="btn btn-sm btn-outline-primary">Edit</a>
@if(in_array(optional(auth()->user()->role)->name,['Super Admin','Admin','Doctor'],true) && $appointment->status==='Pending')
<form method="POST" action="{{ route('appointments.approve',$appointment) }}" class="d-inline">@csrf @method('PATCH')<button class="btn btn-sm btn-outline-success">Approve</button></form>
<form method="POST" action="{{ route('appointments.reject',$appointment) }}" class="d-inline">@csrf @method('PATCH')<button class="btn btn-sm btn-outline-warning">Reject</button></form>
@endif
<form method="POST" action="{{ route('appointments.destroy',$appointment) }}" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete appointment?')">Delete</button></form>
</td></tr>
@empty
<tr><td colspan="6">No appointments found.</td></tr>
@endforelse
</tbody></table>
{{ $appointments->links() }}
</div></div>
@endsection

@extends('layouts.app')

@section('content')
<h3 class="mb-4">Dashboard</h3>
<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="card card-stat"><div class="card-body"><h6>Patients</h6><h3>{{ $patientsCount }}</h3></div></div></div>
    <div class="col-md-3"><div class="card card-stat"><div class="card-body"><h6>Pending Appointments</h6><h3>{{ $pendingAppointments }}</h3></div></div></div>
    <div class="col-md-3"><div class="card card-stat"><div class="card-body"><h6>Pending Deliveries</h6><h3>{{ $pendingDeliveries }}</h3></div></div></div>
    <div class="col-md-3"><div class="card card-stat"><div class="card-body"><h6>Today's Revenue</h6><h3>{{ number_format($todayRevenue, 2) }}</h3></div></div></div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body table-wrap">
        <h5>Latest Appointments</h5>
        <table class="table table-striped align-middle">
            <thead><tr><th>Patient</th><th>Doctor</th><th>Date</th><th>Time</th><th>Status</th></tr></thead>
            <tbody>
                @forelse($latestAppointments as $appointment)
                <tr>
                    <td>{{ optional($appointment->patient)->name }}</td>
                    <td>{{ optional($appointment->doctor)->name }}</td>
                    <td>{{ $appointment->appointment_date?->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}</td>
                    <td>{{ $appointment->status }}</td>
                </tr>
                @empty
                <tr><td colspan="5">No data found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

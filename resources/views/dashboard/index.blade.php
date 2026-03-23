@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h2 class="page-title mb-1">Dashboard</h2>
        <p class="text-muted mb-0">At a glance metrics for today.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('appointments.index') }}" class="btn btn-outline-dark btn-sm">View Appointments</a>
        <a href="{{ route('patients.create') }}" class="btn btn-dark btn-sm">Add Patient</a>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body">
                <h6>Patients</h6>
                <h2 class="mb-0">{{ $patientsCount }}</h2>
                <small class="text-muted">Active records</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body">
                <h6>Pending Appointments</h6>
                <h2 class="mb-0">{{ $pendingAppointments }}</h2>
                <small class="text-muted">Awaiting confirmation</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body">
                <h6>Pending Deliveries</h6>
                <h2 class="mb-0">{{ $pendingDeliveries }}</h2>
                <small class="text-muted">Eyeglass orders</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body">
                <h6>Today's Revenue</h6>
                <h2 class="mb-0">{{ number_format($todayRevenue, 2) }}</h2>
                <small class="text-muted">In local currency</small>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body table-wrap">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="mb-0">Latest Appointments</h5>
                <small class="text-muted">Next 10 bookings</small>
            </div>
            <a href="{{ route('appointments.index') }}" class="btn btn-outline-dark btn-sm">See all</a>
        </div>
        <table class="table align-middle">
            <thead><tr><th>Patient</th><th>Doctor</th><th>Date</th><th>Time</th><th>Status</th></tr></thead>
            <tbody>
                @forelse($latestAppointments as $appointment)
                <tr>
                    <td>{{ optional($appointment->patient)->name }}</td>
                    <td>{{ optional($appointment->doctor)->name }}</td>
                    <td>{{ $appointment->appointment_date?->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}</td>
                    <td>
                        @php
                            $status = $appointment->status;
                            $pillClass = [
                                'Pending' => 'bg-warning text-dark',
                                'Approved' => 'bg-success text-white',
                                'Cancelled' => 'bg-secondary text-white',
                            ][$status] ?? 'bg-secondary text-white';
                        @endphp
                        <span class="badge rounded-pill {{ $pillClass }}" style="min-width:100px; display:inline-block; text-align:center; font-weight:700; letter-spacing:0.2px;">
                            {{ $status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">No data found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

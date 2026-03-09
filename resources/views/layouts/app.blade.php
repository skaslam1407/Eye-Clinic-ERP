<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Eye Clinic ERP' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f7fb; }
        .navbar-brand { font-weight: 700; }
        .card-stat { border: 0; box-shadow: 0 8px 24px rgba(20, 32, 62, 0.07); }
        .table-wrap { overflow-x: auto; }
    </style>
</head>
<body>
@if(auth()->check())
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Eye Clinic ERP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('patients.index') }}">Patients</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('appointments.index') }}">Appointments</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('invoices.index') }}">Invoices</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('sales-reports.index') }}">Sales</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('eyeglass-orders.index') }}">Delivery</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('checkups.index') }}">Checkups</a></li>
                @if(in_array(optional(auth()->user()->role)->name, ['Super Admin', 'Admin'], true))
                <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('notifications.index') }}">Notifications</a></li>
                @endif
            </ul>
            <span class="text-white me-3">{{ auth()->user()->name }} ({{ optional(auth()->user()->role)->name }})</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>
@endif

<div class="container py-4">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
@yield('scripts')
</body>
</html>

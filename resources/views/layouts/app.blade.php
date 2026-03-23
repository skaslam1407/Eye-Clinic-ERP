<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Eye Clinic ERP' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @php
        $font = $branding?->font_family ?? 'Manrope';
        $googleFont = str_replace(' ', '+', $font);
        $brandColor = $branding?->brand_color ?? '#0ea5e9';
    @endphp
    <link href="https://fonts.googleapis.com/css2?family={{ $googleFont }}:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --brand: {{ $brandColor }};
            --brand-strong: {{ $brandColor }};
            --ink: #0f172a;
            --muted: #6b7280;
            --panel: #ffffff;
            --border: #e5e7eb;
            --soft: #f5f7fb;
        }

        * { font-family: '{{ $font }}', 'Segoe UI', Tahoma, sans-serif; }
        body {
            background: radial-gradient(circle at 20% 20%, rgba(14,165,233,0.09), transparent 25%),
                        radial-gradient(circle at 80% 0%, rgba(37,99,235,0.08), transparent 30%),
                        #0b1220;
            color: var(--ink);
            min-height: 100vh;
        }

        .app-surface {
            background: linear-gradient(180deg, rgba(255,255,255,0.94) 0%, rgba(255,255,255,0.96) 20%, #f8fafc 100%);
            min-height: 100vh;
        }

        .navbar-brand { font-weight: 800; letter-spacing: -0.3px; color: var(--ink) !important; }
        .navbar { border-radius: 16px; background: rgba(255,255,255,0.92) !important; backdrop-filter: blur(10px); box-shadow: 0 18px 40px -30px rgba(15,23,42,0.45); }
        .navbar .nav-link { color: var(--muted); font-weight: 600; border-radius: 12px; padding: 0.65rem 0.95rem; }
        .navbar .nav-link:hover, .navbar .nav-link:focus { color: var(--ink); background: #ecfeff; }
        .navbar .nav-link.active { color: var(--ink); background: rgba(14,165,233,0.12); }

        .app-main { max-width: 1200px; }

        .card { border: 1px solid var(--border); border-radius: 16px; box-shadow: 0 16px 40px -24px rgba(15,23,42,0.45); }
        .card-stat { border: 0; background: linear-gradient(135deg, #e0f2fe, #e0f7ff); }
        .card h6 { text-transform: uppercase; letter-spacing: 0.5px; font-size: 0.8rem; color: var(--muted); }

        .table-wrap { overflow-x: auto; }
        .table { margin-bottom: 0; }
        .table thead th { background: #f1f5f9; border-color: var(--border); font-weight: 700; color: var(--ink); }
        .table tbody tr:hover { background: #f8fafc; }
        .table > :not(caption) > * > * { padding: 0.8rem 0.75rem; }

        .form-control, .form-select {
            border-radius: 12px;
            border-color: var(--border);
            box-shadow: none;
        }
        .form-control:focus, .form-select:focus { border-color: var(--brand); box-shadow: 0 0 0 0.15rem rgba(14,165,233,0.25); }

        .btn-dark, .btn-primary { background: linear-gradient(135deg, var(--brand), var(--brand-strong)); border: none; box-shadow: 0 12px 30px -18px var(--brand-strong); font-weight: 700; }
        .btn-outline-dark { color: var(--brand-strong); border-color: var(--brand-strong); font-weight: 700; }
        .btn-outline-dark:hover { background: rgba(14,165,233,0.12); border-color: var(--brand-strong); color: var(--brand-strong); }
        .btn-sm { border-radius: 10px; }

        .alert { border: 0; border-radius: 14px; box-shadow: 0 16px 40px -32px rgba(15,23,42,0.6); }

        .page-title { font-weight: 800; letter-spacing: -0.3px; color: var(--ink); }
        .text-muted { color: var(--muted) !important; }
    </style>
</head>
<body class="app-surface">
@php
    $logoPath = $branding?->logo_path ? asset('storage/'.$branding->logo_path) : null;
@endphp
@if(auth()->check())
<div class="py-3 position-sticky top-0" style="z-index:1020;">
    <div class="container-xxl">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid px-3 px-lg-2">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                    @if($logoPath)
                        <img src="{{ $logoPath }}" alt="Clinic logo" style="height:34px;width:auto;border-radius:10px;object-fit:contain;">
                    @endif
                    <span>Eye Clinic ERP</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto gap-lg-1">
                        @canFeature('patients')
                        <li class="nav-item"><a class="nav-link" href="{{ route('patients.index') }}">Patients</a></li>
                        @endcanFeature
                        @canFeature('appointments')
                        <li class="nav-item"><a class="nav-link" href="{{ route('appointments.index') }}">Appointments</a></li>
                        @endcanFeature
                        @canFeature('invoices')
                        <li class="nav-item"><a class="nav-link" href="{{ route('invoices.index') }}">Invoices</a></li>
                        @endcanFeature
                        @canFeature('reports')
                        <li class="nav-item"><a class="nav-link" href="{{ route('sales-reports.index') }}">Sales</a></li>
                        @endcanFeature
                        @canFeature('eyeglass-orders')
                        <li class="nav-item"><a class="nav-link" href="{{ route('eyeglass-orders.index') }}">Delivery</a></li>
                        @endcanFeature
                        @canFeature('checkups')
                        <li class="nav-item"><a class="nav-link" href="{{ route('checkups.index') }}">Checkups</a></li>
                        @endcanFeature
                        @canFeature('users')
                        <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
                        @endcanFeature
                        @canFeature('notifications')
                        <li class="nav-item"><a class="nav-link" href="{{ route('notifications.index') }}">Notifications</a></li>
                        @endcanFeature
                        @canFeature('branding')
                        <li class="nav-item"><a class="nav-link" href="{{ route('settings.edit') }}">Branding</a></li>
                        @endcanFeature
                        @if(auth()->user()?->role?->name === 'Super Admin')
                        <li class="nav-item"><a class="nav-link" href="{{ route('permissions.edit') }}">Permissions</a></li>
                        @endif
                    </ul>
                    <div class="d-flex align-items-center gap-3">
                        <div class="text-end d-none d-lg-block">
                            <div class="fw-bold">{{ auth()->user()->name }}</div>
                            <small class="text-muted">{{ optional(auth()->user()->role)->name }}</small>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="mb-0">
                            @csrf
                            <button class="btn btn-outline-dark btn-sm">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
@endif

<main class="container-xxl py-4 app-main">
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
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
@yield('scripts')
</body>
</html>

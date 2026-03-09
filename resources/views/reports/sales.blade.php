@extends('layouts.app')

@section('content')
<h4 class="mb-3">Sales Reports</h4>
<form method="GET" class="row g-2 mb-3">
    <div class="col-md-3"><input type="date" name="start_date" value="{{ $startDate }}" class="form-control"></div>
    <div class="col-md-3"><input type="date" name="end_date" value="{{ $endDate }}" class="form-control"></div>
    <div class="col-md-2"><button class="btn btn-outline-dark w-100">Filter</button></div>
    <div class="col-md-2"><a href="{{ route('sales-reports.export-csv', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-dark w-100">Export CSV</a></div>
</form>

<div class="row g-3 mb-4">
    <div class="col-md-2"><div class="card card-stat"><div class="card-body"><small>Daily</small><h6>{{ number_format($totals['daily_sales'],2) }}</h6></div></div></div>
    <div class="col-md-2"><div class="card card-stat"><div class="card-body"><small>Monthly</small><h6>{{ number_format($totals['monthly_sales'],2) }}</h6></div></div></div>
    <div class="col-md-3"><div class="card card-stat"><div class="card-body"><small>Eyeglass</small><h6>{{ number_format($totals['eyeglass_sales'],2) }}</h6></div></div></div>
    <div class="col-md-3"><div class="card card-stat"><div class="card-body"><small>Medicine</small><h6>{{ number_format($totals['medicine_sales'],2) }}</h6></div></div></div>
    <div class="col-md-2"><div class="card card-stat"><div class="card-body"><small>Total</small><h6>{{ number_format($totals['total_revenue'],2) }}</h6></div></div></div>
</div>

<div class="card border-0 shadow-sm"><div class="card-body"><canvas id="salesChart" height="90"></canvas></div></div>
@endsection

@section('scripts')
<script>
const chartData = @json($chartData);
new Chart(document.getElementById('salesChart'), {
    type: 'line',
    data: {
        labels: chartData.map(item => item.invoice_date),
        datasets: [{ label: 'Revenue', data: chartData.map(item => Number(item.total)), borderColor: '#0d6efd', backgroundColor: 'rgba(13,110,253,.2)', fill: true }]
    },
});
</script>
@endsection

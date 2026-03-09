@extends('layouts.app')

@section('content')
<h4 class="mb-3">Create Invoice</h4>
<div class="card border-0 shadow-sm"><div class="card-body">
<form method="POST" action="{{ route('invoices.store') }}">@csrf
@include('invoices._form')
<div class="mt-3"><button class="btn btn-dark">Save Invoice</button></div>
</form>
</div></div>
@endsection

@section('scripts')
<script>
const fields = ['eye_test_charges', 'eyeglass_charges', 'medicine_charges'];
function calcTotal() {
    const total = fields.reduce((sum, key) => sum + parseFloat(document.getElementById(key).value || 0), 0);
    document.getElementById('total_amount').value = total.toFixed(2);
}
fields.forEach((id) => document.getElementById(id).addEventListener('input', calcTotal));
calcTotal();
</script>
@endsection

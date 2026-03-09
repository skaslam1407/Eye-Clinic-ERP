@extends('layouts.app')

@section('content')
<h4 class="mb-3">Patient Details</h4>
<div class="card border-0 shadow-sm"><div class="card-body">
    <div class="row g-2">
        <div class="col-md-4"><strong>Code:</strong> {{ $patient->patient_code }}</div>
        <div class="col-md-4"><strong>Name:</strong> {{ $patient->name }}</div>
        <div class="col-md-4"><strong>Age:</strong> {{ $patient->age }}</div>
        <div class="col-md-4"><strong>Gender:</strong> {{ $patient->gender }}</div>
        <div class="col-md-4"><strong>Phone:</strong> {{ $patient->phone }}</div>
        <div class="col-md-4"><strong>Email:</strong> {{ $patient->email }}</div>
        <div class="col-md-12"><strong>Address:</strong> {{ $patient->address }}</div>
        <div class="col-md-12"><strong>Eye Problem:</strong> {{ $patient->eye_problem }}</div>
    </div>
</div></div>
@endsection

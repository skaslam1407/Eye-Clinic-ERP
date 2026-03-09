@extends('layouts.app')
@section('content')
<h4 class="mb-3">Create Appointment</h4>
<div class="card border-0 shadow-sm"><div class="card-body">
<form method="POST" action="{{ route('appointments.store') }}">@csrf @include('appointments._form')<div class="mt-3"><button class="btn btn-dark">Save</button></div></form>
</div></div>
@endsection

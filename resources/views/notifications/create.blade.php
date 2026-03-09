@extends('layouts.app')
@section('content')
<h4 class="mb-3">Send Mobile Notification</h4>
<div class="card border-0 shadow-sm"><div class="card-body">
<form method="POST" action="{{ route('notifications.store') }}">@csrf
<div class="row g-3">
<div class="col-md-6"><label class="form-label">Patient (optional)</label><select name="patient_id" class="form-select"><option value="">General</option>@foreach($patients as $patient)<option value="{{ $patient->id }}">{{ $patient->name }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label">Recipient Mobile</label><input name="recipient" class="form-control" required></div>
<div class="col-md-4"><label class="form-label">Channel</label><select name="channel" class="form-select" required>@foreach(['SMS','WhatsApp','Push'] as $c)<option value="{{ $c }}">{{ $c }}</option>@endforeach</select></div>
<div class="col-md-8"><label class="form-label">Type</label><select name="type" class="form-select" required>@foreach(['Eye Checkup Reminder','Appointment Reminder','Eye Camp Schedule'] as $t)<option value="{{ $t }}">{{ $t }}</option>@endforeach</select></div>
<div class="col-md-12"><label class="form-label">Message</label><textarea name="message" rows="4" class="form-control" required></textarea></div>
</div>
<div class="mt-3"><button class="btn btn-dark">Send</button></div>
</form>
</div></div>
@endsection

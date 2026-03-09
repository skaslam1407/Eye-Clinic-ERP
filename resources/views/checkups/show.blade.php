@extends('layouts.app')
@section('content')
<h4 class="mb-3">Checkup Details</h4>
<div class="card border-0 shadow-sm"><div class="card-body">
<p><strong>Patient:</strong> {{ optional($checkup->patient)->name }}</p>
<p><strong>Doctor:</strong> {{ optional($checkup->doctor)->name }}</p>
<p><strong>Vision Test:</strong> {{ $checkup->vision_test }}</p>
<p><strong>Right/Left Vision:</strong> {{ $checkup->right_eye_vision }} / {{ $checkup->left_eye_vision }}</p>
<p><strong>Lens Power:</strong> {{ $checkup->lens_power }}</p>
<p><strong>SPH/CYL/Axis:</strong> {{ $checkup->sph }} / {{ $checkup->cyl }} / {{ $checkup->axis }}</p>
<p><strong>Condition:</strong> {{ $checkup->eye_condition }}</p>
<p><strong>Doctor Notes:</strong> {{ $checkup->doctor_notes }}</p>
<p><strong>Prescription:</strong> {{ $checkup->prescription }}</p>
<p><strong>Recommended Glasses:</strong> {{ $checkup->recommended_glasses }}</p>
<p><strong>Follow-up Date:</strong> {{ $checkup->follow_up_date?->format('Y-m-d') }}</p>
</div></div>
@endsection

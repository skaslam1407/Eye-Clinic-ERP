@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3"><h4>Eye Checkup Forms</h4><a class="btn btn-dark" href="{{ route('checkups.create') }}">New Checkup</a></div>
<div class="card border-0 shadow-sm"><div class="card-body table-wrap">
<table class="table table-striped"><thead><tr><th>Patient</th><th>Doctor</th><th>Condition</th><th>Follow-up</th><th class="text-end">Action</th></tr></thead>
<tbody>
@forelse($checkups as $checkup)
<tr><td>{{ optional($checkup->patient)->name }}</td><td>{{ optional($checkup->doctor)->name }}</td><td>{{ $checkup->eye_condition }}</td><td>{{ $checkup->follow_up_date?->format('Y-m-d') }}</td><td class="text-end"><a href="{{ route('checkups.show',$checkup) }}" class="btn btn-sm btn-outline-secondary">View</a> <a href="{{ route('checkups.edit',$checkup) }}" class="btn btn-sm btn-outline-primary">Edit</a> <form method="POST" action="{{ route('checkups.destroy',$checkup) }}" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete checkup?')">Delete</button></form></td></tr>
@empty
<tr><td colspan="5">No checkup forms found.</td></tr>
@endforelse
</tbody></table>
{{ $checkups->links() }}
</div></div>
@endsection

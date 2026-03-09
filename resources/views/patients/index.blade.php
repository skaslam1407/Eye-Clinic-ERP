@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Patients</h4>
    <a href="{{ route('patients.create') }}" class="btn btn-dark">Add Patient</a>
</div>
<form method="GET" class="row g-2 mb-3">
    <div class="col-md-4"><input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Search by name, code, phone"></div>
    <div class="col-md-2"><button class="btn btn-outline-dark w-100">Search</button></div>
</form>
<div class="card border-0 shadow-sm"><div class="card-body table-wrap">
<table class="table table-striped align-middle">
    <thead><tr><th>Code</th><th>Name</th><th>Age</th><th>Gender</th><th>Phone</th><th>Problem</th><th class="text-end">Action</th></tr></thead>
    <tbody>
    @forelse($patients as $patient)
    <tr>
        <td>{{ $patient->patient_code }}</td><td>{{ $patient->name }}</td><td>{{ $patient->age }}</td><td>{{ $patient->gender }}</td><td>{{ $patient->phone }}</td><td>{{ $patient->eye_problem }}</td>
        <td class="text-end">
            <a href="{{ route('patients.show',$patient) }}" class="btn btn-sm btn-outline-secondary">View</a>
            <a href="{{ route('patients.edit',$patient) }}" class="btn btn-sm btn-outline-primary">Edit</a>
            <form class="d-inline" method="POST" action="{{ route('patients.destroy',$patient) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete patient?')">Delete</button></form>
        </td>
    </tr>
    @empty
    <tr><td colspan="7">No patients found.</td></tr>
    @endforelse
    </tbody>
</table>
{{ $patients->links() }}
</div></div>
@endsection

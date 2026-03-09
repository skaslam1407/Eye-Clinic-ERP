@extends('layouts.app')

@section('content')

<div class="card shadow">
    <div class="card-header bg-warning">
        <h4>Edit Student</h4>
    </div>

    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('students.update',$student->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" value="{{ $student->name }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ $student->email }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" value="{{ $student->phone }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Course</label>
                <input type="text" name="course" value="{{ $student->course }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>

        </form>
    </div>
</div>

@endsection
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h4 class="mb-3">Forgot Password</h4>
                <p class="text-muted mb-3">Enter your email to receive a reset link.</p>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <button class="btn btn-dark w-100">Send Reset Link</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

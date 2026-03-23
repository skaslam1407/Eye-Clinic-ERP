@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h4 class="mb-3">Login</h4>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div></div>
                        <a href="{{ route('password.request') }}" class="small text-decoration-none">Forgot password?</a>
                    </div>
                    <button class="btn btn-dark w-100">Sign In</button>
                </form>
                <small class="text-muted d-block mt-3">Seed user: admin@eyeclinic.test / Password@123</small>
            </div>
        </div>
    </div>
</div>
@endsection
